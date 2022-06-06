@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Members</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Members</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<a class="btn btn-primary mb-3" href="/dashboard/members/create"><span data-feather="user-plus"></span> Add Member</a>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 15%">Member Code</th>
                <th scope="col" style="width: 40%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" style="width: 10%">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($members as $member)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $member->member_code }}</td>
                <td>{{ $member->user->name }}</td>
                <td>{{ $member->user->email }}</td>
                <td>
                    <a class="badge bg-info" href="/dashboard/members/{{ $member->user->username }}"><span data-feather="eye"></span></a>
                    <a class="badge bg-warning" href="/dashboard/members/{{ $member->user->username }}/edit"><span data-feather="edit"></span></a>
                    <form action="/dashboard/members/{{ $member->user->username }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" type="submit" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
