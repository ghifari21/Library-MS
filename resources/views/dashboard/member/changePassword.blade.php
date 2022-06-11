@extends('dashboard.layouts.main')

@section('container')
<h2 class="text-center my-3">Change Password</h2>
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/change-password" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="old_password" class="form-control rounded-top @error('old_password') is-invalid @enderror" id="old_password" placeholder="Current Password">
                    <label for="old_password">Current Password</label>
                    @error('old_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-top @error('password') is-invalid @enderror" id="password" placeholder="New Password" required>
                    <label for="password">New Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="re_password" class="form-control rounded-top @error('re_password') is-invalid @enderror" id="re_password" placeholder="Re-enter New Password" required>
                    <label for="re_password">Re-enter New Password</label>
                    @error('re_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Change Password</button>
            </form>
        </main>
    </div>
</div>
@endsection
