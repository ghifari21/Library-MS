<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Circulation;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->account_type === "admin") {
            return view('dashboard.admin.index', [
                'collections' => Collection::all(),
                'authors' => Author::all(),
                'publishers' => Publisher::all(),
                'categories' => Category::all(),
                'members' => Member::all(),
                'transactions' => Circulation::all(),
                'borrowed' => Circulation::where('status', 'Borrowed')->get(),
                'returned' => Circulation::where('status', 'Returned')->get(),
                'exceed' => Circulation::where([
                    ['return_deadline', '<', today()],
                    ['status', 'borrowed']
                ])->get()
            ]);
        } else {
            return view('dashboard.member.index');
        }
    }
}
