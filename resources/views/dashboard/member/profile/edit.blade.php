@extends('dashboard.layouts.main')

@section('container')
<h2 class="text-center my-3">Edit Profile</h2>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/members/{{ $member->user->username }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name', $member->user->name) }}">
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-floating mb-3">
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="NIK" required value="{{ old('nik', $member->nik) }}">
                            <label for="nik">NIK</label>
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-floating mb-3">
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" required value="{{ old('phone', $member->phone) }}">
                            <label for="phone">Phone</label>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" required placeholder="Address" style="height: 100px;">{{ old('address', $member->address) }}</textarea>
                    <label for="address">Address</label>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username', $member->user->username) }}">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email', $member->user->email) }}">
                            <label for="email">Email address</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo Profile</label>
                    <input type="hidden" name="old_photo" value="{{ $member->photo }}">
                    <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" onchange="previewImage()">
                    @if ($member->photo)
                        <img class="img-preview img-thumbnail rounded-circle my-3 col-sm-3" src="{{ asset('storage/' . $member->photo) }}">
                    @else
                        <img class="img-preview img-thumbnail rounded-circle my-3 col-sm-3 d-none">
                    @endif
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
            </form>
        </main>
    </div>
</div>
@endsection
