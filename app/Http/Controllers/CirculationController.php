<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use App\Models\Member;
use App\Models\Collection;
use App\Models\Circulation;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CirculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('needToReturn') != 1) {
            $circulation = Circulation::where('status', '!=', 'Pending')->filter(request(['search', 'duration', 'status', 'borrowed_date', 'returned_date', 'return_deadline']))->paginate(25)->withQueryString();
        } else {
            $circulation = Circulation::where([
                ['status', 'Borrowed'],
                ['return_deadline', '<', today()]
            ])->filter(request(['search', 'duration', 'status', 'borrowed_date', 'returned_date', 'return_deadline']))->paginate(25)->withQueryString();
        }
        return view('dashboard.admin.transactions.index', [
            'circulations' => $circulation
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function create(Collection $collection)
    {
        return view('dashboard.admin.transactions.create', [
            'collection' => $collection
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Models\Collection $collection
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Collection $collection)
    {
        $request->validate([
            'member_code' => 'required|exists:members,member_code'
        ]);

        $member = Member::firstWhere('member_code', $request->member_code);
        $borrowedCollectionByMember = Circulation::where([
            ['member_id', $member->id],
            ['status', 'Borrowed']
        ]);

        if ($borrowedCollectionByMember->count() >= 5) {
            if (auth()->user()->account_type === 'admin') {
                return redirect("/dashboard/members/$member->member_code")->with('failed', 'This member has exceeded the borrowing limit!');
            } else {
                return redirect('/dashboard')->with('failed', 'You has exceeded the borrowing limit!');
            }
        }

        $validatedData = $request->validate([
            'borrowed_date' => 'required',
            'duration' => 'required'
        ]);

        $validatedData['member_id'] = $member->id;
        $validatedData['collection_id'] = $collection->id;

        $date_interval = $validatedData['duration'] . ' day';
        $date_in = date_create($validatedData['borrowed_date']);
        $validatedData['return_deadline'] = date_add($date_in, date_interval_create_from_date_string($date_interval));
        $validatedData['return_deadline']->format('Y-m-d');

        $today = today()->format('d-m-Y');
        $date = str_replace('-', '', $today);
        $circulation = Circulation::latest()->first();
        if ($circulation) {
            $validatedData['transaction_code'] = 'TC-' . $date . '-' . $circulation->id + 1;
        } else {
            $validatedData['transaction_code'] = 'TC-' . $date . '-1';
        }

        if (auth()->user()->account_type === 'member') {
            $validatedData['status'] = 'Pending';
        }

        $collection->is_available = false;
        $collection->save();

        $bibliography = Bibliography::firstWhere('id', $collection->bibliography_id);
        $bibliography->decrement('stock');
        $bibliography->save();

        Circulation::create($validatedData);
        $code = $validatedData['transaction_code'];
        return redirect("/ticket/$code");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function show(Circulation $circulation)
    {
        return view('dashboard.admin.transactions.show', [
            'circulation' => $circulation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function edit(Circulation $circulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Circulation $circulation)
    {
        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        if ($validatedData['status'] === 'Borrowed') {
            Circulation::where('id', $circulation->id)->update($validatedData);

            return redirect('/dashboard/requests')->with('success', 'This request has been accepted!');
        } else {
            $validatedData['returned_date'] = today();

            $collection = Collection::firstWhere('id', $circulation->collection->id);
            $collection->is_available = true;
            $collection->save();

            $bibliography = Bibliography::firstWhere('id', $collection->bibliography_id);
            $bibliography->increment('stock');
            $bibliography->save();

            Circulation::where('id', $circulation->id)->update($validatedData);

            return redirect('/dashboard/transactions')->with('success', 'Collection has been returned!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circulation $circulation)
    {
        Circulation::destroy($circulation->id);

        return redirect('/dashboard/transactions')->with('success', 'This transaction has been deleted!');
    }

    /**
     * Show transaction tikcet
     *
     * @param \App\Models\Circulation $circulation
     * @return \Illuminate\Http\Response
     */
    public function ticket(Circulation $circulation) {
        return view('transaction.ticket', [
            'title' => 'Ticket',
            'circulation' => $circulation,
            'qrCode' => QrCode::size(200)->generate(env('APP_URL') . '/transaction/' . $circulation->transaction_code)
        ]);
    }

    /**
     * Show detail of a transaction
     *
     * @param \App\Models\Circulation $circulation
     * @return \Illuminate\Http\Response
     */
    public function transaction(Circulation $circulation) {
        return view('transaction.show', [
            'title' => 'Detail',
            'circulation' => $circulation
        ]);
    }

    /**
     * Show request to borrow a book from member
     *
     * @return \Illuminate\Http\Response
     */
    public function requestToBorrow() {
        return view('dashboard.admin.transactions.request', [
            'circulations' => Circulation::where('status', 'Pending')->filter(request(['search', 'duration', 'borrowed_date', 'return_deadline']))->paginate(25)->withQueryString()
        ]);
    }

    /**
     * Reject request to borrow a book from member
     *
     * @param \App\Models\Circulation $circulation
     * @return \Illuminate\Http\Response
     */
    public function rejectRequest(Circulation $circulation) {
        $collection = Collection::firstWhere('collection_id', $circulation->collection_id);
        $collection->is_available = true;
        $collection->save();
        $bibliography = Bibliography::firstWhere('id', $collection->bibliography_id);
        $bibliography->increment('stock');
        $bibliography->save();

        Circulation::destroy($circulation->id);

        return redirect('/dashboard/request')->with('success', 'This request has been rejected!');
    }
}
