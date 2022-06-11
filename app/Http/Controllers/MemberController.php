<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Circulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index() {
        return view('dashboard.admin.members.index', [
            'members' => Member::filter(request(['search']))->orderBy('member_code', 'ASC')->paginate(25)->withQueryString()
        ]);
    }

    public function create() {
        return view('dashboard.admin.members.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:255'
        ]);

        $request->validate([
            'repassword' => 'required|same:password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $memberData = $request->validate([
            'nik' => 'required|size:16',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|file|max:5120'
        ]);

        if ($request->file('photo')) {
            $memberData['photo'] = $request->file('photo')->store('members');
        }

        $member = Member::latest()->first();
        if ($member) {
            $memberData['member_code'] = 'M' . $member->id+1;
        } else {
            $memberData['member_code'] = 'M1';
        }

        $user = User::firstWhere('username', $validatedData['username']);
        $memberData['user_id'] = $user->id;
        Member::create($memberData);

        return redirect('/dashboard/members')->with('success', 'Registration member successfull!');
    }

    public function show(User $user) {
        $member = Member::firstWhere('user_id', $user->id);
        return view('dashboard.admin.members.show', [
            'member' => $member,
            'circulations' => Circulation::where('member_id', $member->id)->latest()->get()
        ]);
    }

    public function edit(User $user) {
        $member = Member::firstWhere('user_id', $user->id);
        return view('dashboard.admin.members.edit', [
            'member' => $member
        ]);
    }

    public function update(Request $request, User $user) {
        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:3|max:255|unique:users';
        } else {
            $rules['username'] = 'required|min:3|max:255';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        } else {
            $rules['email'] = 'required|email:dns';
        }

        $userData = $request->validate($rules);

        $memberData = $request->validate([
            'nik' => 'required|size:16',
            'phone' => 'required',
            'address' => 'required',
            'photo' => 'image|file|max:5120'
        ]);

        if ($request->file('photo')) {
            if ($request->old_photo) {
                Storage::delete($request->old_photo);
            }
            $memberData['photo'] = $request->file('photo')->store('members');
        }

        User::where('id', $user->id)->update($userData);
        Member::where('user_id', $user->id)->update($memberData);

        if (auth()->user()->account_type === 'admin') {
            return redirect('/dashboard/members')->with('success', 'Update member profile successfull!');
        } else {
            return redirect('/dashboard/profile/' . auth()->user()->username)->with('success', 'Your profile has been updated!');
        }
    }

    public function destroy(User $user) {
        $member = Member::firstWhere('user_id', $user->id);
        if ($member->photo) {
            Storage::delete($member->photo);
        }

        User::destroy($user->id);

        return redirect('/dashboard/members')->with('success', 'Member has been deleted!');
    }
}
