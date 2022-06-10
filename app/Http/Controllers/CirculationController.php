<?php

namespace App\Http\Controllers;

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
        return view('dashboard.admin.transactions.index', [
            'circulations' => Circulation::orderBy('status')->get()
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
            return redirect("/dashboard/members/$member->member_code")->with('failed', 'This member has exceeded the borrowing limit!');
        }

        $validatedData = $request->validate([
            'borrowed_date' => 'required',
            'duration' => 'required'
        ]);

        $validatedData['member_id'] = $member->id;
        $validatedData['collection_id'] = $collection->id;
        $validatedData['is_available'] = 0;

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

        $validatedData['returned_date'] = today();

        Circulation::where('id', $circulation->id)->update($validatedData);

        return redirect('/dashboard/transactions')->with('success', 'Collection has been returned!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circulation  $circulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Circulation $circulation)
    {
        //
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
            'qrCode' => QrCode::size(200)->generate('http://library.test/transaction/' . $circulation->transaction_code)
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
}
