<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.publishers.index', [
            'publishers' => Publisher::filter(request(['search']))->orderBy('publisher_code', 'ASC')->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:publishers',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|file|max:5120'
        ]);

        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('publishers');
        }

        $publisher = Publisher::latest()->first();
        if ($publisher) {
            $validatedData['publisher_code'] = 'P' . $publisher->id + 1;
        } else {
            $validatedData['publisher_code'] = 'P1';
        }

        Publisher::create($validatedData);

        return redirect('/dashboard/publishers')->with('success', 'New publisher has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        return view('dashboard.admin.publishers.show', [
            'publisher' => $publisher,
            'bibliographies' => Bibliography::where('publisher_id', $publisher->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('dashboard.admin.publishers.edit', [
            'publisher' => $publisher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|file|max:5120'
        ];

        if ($request->email != $publisher->email) {
            $rules['email'] = 'required|email:dns|unique:publishers';
        } else {
            $rules['email'] = 'required|email:dns';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($request->old_photo) {
                Storage::delete($request->old_photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('publishers');
        }

        Publisher::where('id', $publisher->id)->update($validatedData);

        return redirect('/dashboard/publishers')->with('success', 'Publisher has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        if ($publisher->photo) {
            Storage::delete($publisher->photo);
        }

        Publisher::destroy($publisher->id);

        return redirect('/dashboard/publishers')->with('success', 'Publisher has been deleted!');
    }
}
