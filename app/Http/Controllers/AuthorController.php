<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Bibliography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.authors.index', [
            'authors' => Author::filter(request(['search']))->orderBy('author_code', 'ASC')->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.authors.create');
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
            'email' => 'required|email:dns|unique:authors',
            'photo' => 'image|file|max:5120'
        ]);

        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('authors');
        }

        $author = Author::latest()->first();
        if ($author) {
            $validatedData['author_code'] = 'A' . $author->id+1;
        } else {
            $validatedData['author_code'] = 'A1';
        }

        Author::create($validatedData);

        return redirect('/dashboard/authors')->with('success', 'New author has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return view('dashboard.admin.authors.show', [
            'author' => $author,
            'bibliographies' => Bibliography::where('author_id', $author->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('dashboard.admin.authors.edit', [
            'author' => $author
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $rules = [
            'name' => 'required|max:255',
            'photo' => 'image|file|max:5120'
        ];

        if ($author->email != $request->email) {
            $rules['email'] = 'required|email:dns|unique:authors';
        } else {
            $rules['email'] = 'required|email:dns';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($request->old_photo) {
                Storage::delete($request->old_photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('authors');
        }

        Author::where('id', $author->id)->update($validatedData);

        return redirect('/dashboard/authors')->with('success', 'Author has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->photo) {
            Storage::delete($author->photo);
        }

        Author::destroy($author->id);

        return redirect('/dashboard/authors')->with('success', 'Author has been deleted!');
    }
}
