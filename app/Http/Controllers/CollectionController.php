<?php

namespace App\Http\Controllers;

use App\Models\Bibliography;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Bibliography $bibliography
     * @return \Illuminate\Http\Response
     */
    public function create(Bibliography $bibliography)
    {
        return view('dashboard.admin.collections.create', [
            'bibliography' => $bibliography
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Models\Bibliography $bibliography
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bibliography $bibliography)
    {
        $validatedData = $request->validate([
            'stored_shelf' => 'required',
            'condition' => 'required'
        ]);

        $validatedData['bibliography_id'] = $bibliography->id;
        $today = today()->format('d-m-Y');
        $date = str_replace('-', '', $today);
        $collection = Collection::latest()->first();
        if ($collection) {
            $validatedData['collection_code'] = 'CC' . $collection->id + 1;
            $validatedData['registry_number'] = 'R-' . $date . '-' . $collection->id + 1;
        } else {
            $validatedData['collection_code'] = 'CC1';
            $validatedData['registry_number'] = 'R-' . $date . '-1';
        }

        Collection::create($validatedData);

        return redirect("/dashboard/bibliographies/$bibliography->book_code")->with('success', 'New collection has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('dashboard.admin.collections.edit', [
            'collection' => $collection
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $validatedData = $request->validate([
            'stored_shelf' => 'required',
            'condition' => 'required'
        ]);

        Collection::where('id', $collection->id)->update($validatedData);
        $bookCode = $collection->bibliography->book_code;
        return redirect("/dashboard/bibliographies/$bookCode")->with('success', 'Collection has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        Collection::destroy($collection->id);
        $bookCode = $collection->bibliography->book_code;
        return redirect("/dashboard/bibliographies/$bookCode")->with('success', 'Collection has been deleted!');
    }
}
