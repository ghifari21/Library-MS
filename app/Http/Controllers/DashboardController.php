<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Author;
use App\Models\Member;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Collection;
use App\Models\Circulation;
use App\Models\Bibliography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->account_type === "admin") {
            return view('dashboard.admin.index', [
                'collections' => Collection::all(),
                'bibliographies' => Bibliography::all(),
                'authors' => Author::all(),
                'publishers' => Publisher::all(),
                'categories' => Category::all(),
                'members' => Member::all(),
                'transactions' => Circulation::all(),
                'borrowed' => Circulation::where('status', 'Borrowed')->get(),
                'returned' => Circulation::where('status', 'Returned')->get(),
                'exceed' => Circulation::where([
                    ['return_deadline', '<', today()],
                    ['status', 'Borrowed']
                ])->get(),
                'requests' => Circulation::where('status', 'Pending')->get()
            ]);
        } else {
            $member = Member::firstWhere('user_id', auth()->user()->id);
            return view('dashboard.member.index', [
                'circulations' => Circulation::where('member_id', $member->id)->get(),
                'borrowed' => Circulation::where([
                    ['member_id', $member->id],
                    ['status', 'Borrowed']
                ])->get(),
                'return' => Circulation::where([
                    ['member_id', $member->id],
                    ['return_deadline', '<=', today()],
                    ['status', 'Borrowed']
                ])->get()
            ]);
        }
    }

    public function profile(User $user) {
        return view('dashboard.member.profile.index', [
            'member' => Member::firstWhere('user_id', $user->id)
        ]);
    }

    public function editProfile(User $user) {
        return view('dashboard.member.profile.edit', [
            'member' => Member::firstWhere('user_id', $user->id)
        ]);
    }

    public function viewChangePassword() {
        return view('dashboard.member.changePassword');
    }

    public function changePassword(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
        ]);

        if (auth()->user()->username != $credentials['username']) {
            abort(403);
        }

        $credentials['password'] = $request->old_password;

        if (Auth::attempt($credentials)) {
            $new_password = $request->validate([
                'password' => 'required|min:8'
            ]);
            if ($new_password['password'] != $credentials['password']) {
                $request->validate([
                    're_password' => 'required|same:password'
                ]);
                $new_password['password'] = Hash::make($new_password['password']);
                // dd($new_password['password']);
                User::where('id', auth()->user()->id)->update($new_password);

                return redirect('/dashboard/profile/' . auth()->user()->username)->with('success', 'Your password has been changed!');
            }
        }
        return back()->with('error', 'There is an error!');
    }

    public function transaction(User $user) {
        $member = Member::firstWhere('user_id', $user->id);
        if (request('needToReturn') != 1) {
            $circulations = Circulation::where('member_id', $member->id)->filter(request(['duration', 'status', 'borrowed_date', 'returned_date', 'return_deadline']))->paginate(25)->withQueryString();
        } else {
            $circulations = Circulation::where([
                ['member_id', $member->id],
                ['return_deadline', '<=', today()],
                ['status', 'Borrowed']
            ])->filter(request(['duration', 'status', 'borrowed_date', 'returned_date', 'return_deadline']))->paginate(25)->withQueryString();
        }
        return view('dashboard.member.transactions', [
            'circulations' => $circulations
        ]);
    }
}
