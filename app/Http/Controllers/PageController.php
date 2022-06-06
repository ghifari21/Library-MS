<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('index', [
            'title' => 'Home',
            'collections' => Collection::all(),
            'authors' => Author::all(),
            'publishers' => Publisher::all(),
            'categories' => Category::all()
        ]);
    }

    public function redirectToHome() {
        return redirect('/home');
    }
}
