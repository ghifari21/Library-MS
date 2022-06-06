<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register.index', [
            'title' => 'Register'
        ]);
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

        return redirect('/login')->with('success', 'Registration successfull!');
    }
}
