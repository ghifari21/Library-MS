@extends('dashboard.layouts.main')

@section('container')
<h2 class="text-center my-3">Profile</h2>

@if (session()->has('failed'))
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    {{ session('failed') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mt-3">
    <a class="btn btn-warning" href="/dashboard/profile/{{ $member->user->username }}/edit">Edit Profile</a>
</div>
<div class="row mt-3">
    <div class="col-md-2 mb-3">
        @if ($member->photo)
            <img class="img-thumbnail rounded-circle" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->user->name }}">
        @else
            <img class="img-thumbnail rounded-circle" src="/img/blank-profile-picture.png" alt="blank">
        @endif
    </div>
    <div class="col-md-10 mb-3">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 15%;">Member Code</th>
                            <td>: {{ $member->member_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>: {{ $member->user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">NIK</th>
                            <td>: {{ $member->nik }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Username</th>
                            <td>: {{ $member->user->username }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>: {{ $member->user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td>: {{ $member->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td>: {{ $member->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
