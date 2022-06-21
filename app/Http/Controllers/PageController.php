<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Collection;
use App\Models\Bibliography;
use App\Models\Member;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('index', [
            'title' => 'Home',
            'bibliographies' => Bibliography::all(),
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
    }

    public function redirectToHome() {
        return redirect('/home');
    }

    public function bibliographies() {
        return view('browse', [
            'title' => 'Bibliographies',
            'bibliographies' => Bibliography::filter(request(['search', 'author', 'publisher', 'category', 'language', 'published_year']))->orderBy('book_code', 'ASC')->paginate(10)->withQueryString(),
            'authors' => Author::all(),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
        ]);
    }

    public function detailBiblio(Bibliography $bibliography) {
        return view('show', [
            'title' => $bibliography->title,
            'bibliography' => $bibliography,
            'collections' => Collection::where('bibliography_id', $bibliography->id)->get(),
        ]);
    }

    public function borrowForm(Collection $collection) {
        return view('transaction.create', [
            'title' => 'Borrowing Form',
            'collection' => $collection,
            'member' => Member::firstWhere('user_id', auth()->user()->id)
        ]);
    }

    public function categories() {
        return view('categories', [
            'title' => 'Categories',
            'categories' => Category::filter(request(['search']))->orderBy('name', 'ASC')->paginate(10)->withQueryString()
        ]);
    }

    public function authors() {
        return view('authors', [
            'title' => 'Authors',
            'authors' => Author::filter(request(['search']))->orderBy('name', 'ASC')->paginate(10)->withQueryString()
        ]);
    }

    public function publishers() {
        return view('publishers', [
            'title' => 'Publishers',
            'publishers' => Publisher::filter(request(['search']))->orderBy('name', 'ASC')->paginate(10)->withQueryString()
        ]);
    }
}
