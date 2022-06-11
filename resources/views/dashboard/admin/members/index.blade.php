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
<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary mb-3" href="/dashboard/members/create"><span data-feather="user-plus"></span> Add Member</a>
    </div>
    <div class="col-md-4 text-end">
        <form action="/dashboard/members" method="get" class="text-end">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search"><span data-feather="search"></span> Search</button>
            </div>
        </form>
    </div>
</div>
@if ($members->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 15%">Member Code</th>
                <th scope="col" style="width: 30%">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Last Updated</th>
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
                <td>{{ $member->updated_at->diffForHumans() }}</td>
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
<div class="d-flex justify-content-end">
    {{ $members->links() }}
</div>
@else
<p class="text-center mb-3 fs-5">No member found.</p>
@endif
@endsection
