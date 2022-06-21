<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Bibliography;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BibliographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.bibliographies.index', [
            'bibliographies' => Bibliography::filter(request(['search', 'author', 'publisher', 'category', 'language', 'published_year']))->orderBy('book_code', 'ASC')->paginate(10)->withQueryString(),
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.bibliographies.create', [
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
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
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
            'isbn' => 'required|unique:bibliographies',
            'language' => 'required',
            'published_year' => 'required',
            'photo' => 'image|file|max:5120'
        ]);

        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('bibliographies');
        }

        $bibliography = Bibliography::latest()->first();
        if ($bibliography) {
            $validatedData['book_code'] = 'B' . $bibliography->id + 1;
        } else {
            $validatedData['book_code'] = 'B1';
        }

        Bibliography::create($validatedData);

        return redirect('/dashboard/bibliographies')->with('success', 'New bibliographies has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function show(Bibliography $bibliography)
    {
        return view('dashboard.admin.bibliographies.show', [
            'bibliography' => $bibliography,
            'collections' => Collection::where('bibliography_id', $bibliography->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function edit(Bibliography $bibliography)
    {
        return view('dashboard.admin.bibliographies.edit', [
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all(),
            'bibliography' => $bibliography
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bibliography $bibliography)
    {
        $rules = [
            'title' => 'required|max:255',
            'author_id' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
            'language' => 'required',
            'published_year' => 'required',
            'photo' => 'image|file|max:5120'
        ];

        if ($request->isbn != $bibliography->isbn) {
            $rules['isbn'] = 'required|unique:bibliographies';
        } else {
            $rules['isbn'] = 'required';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($request->old_photo) {
                Storage::delete($request->old_photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('bibliographies');
        }

        Bibliography::where('id', $bibliography->id)->update($validatedData);

        return redirect('/dashboard/bibliographies')->with('success', 'Bibliographies has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bibliography  $bibliography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bibliography $bibliography)
    {
        if ($bibliography->photo) {
            Storage::delete($bibliography->photo);
        }

        Bibliography::destroy($bibliography->id);

        return redirect('/dashboard/bibliographies')->with('success', 'Bibliography has been deleted!');
    }
}
