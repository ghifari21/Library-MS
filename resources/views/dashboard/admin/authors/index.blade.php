@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Authors</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Authors</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container d-flex justify-content-xl-between p-0 m-0">
    <a class="btn btn-primary mb-3" href="/dashboard/authors/create"><span data-feather="user-plus"></span> Add Author</a>
    <form action="/dashboard/authors" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit" id="search"><span data-feather="search"></span> Search</button>
        </div>
    </form>
</div>
@if ($authors->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 15%">Author Code</th>
                <th scope="col" style="width: 35%">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Last Updated</th>
                <th scope="col" style="width: 10%">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($authors as $author)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $author->author_code }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->updated_at->diffForHumans() }}</td>
                <td>
                    <a class="badge bg-info" href="/dashboard/authors/{{ $author->author_code }}"><span data-feather="eye"></span></a>
                    <a class="badge bg-warning" href="/dashboard/authors/{{ $author->author_code }}/edit"><span data-feather="edit"></span></a>
                    <form action="/dashboard/authors/{{ $author->author_code }}" method="post" class="d-inline">
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
@else
<p class="text-center mb-3 fs-5">No author found.</p>
@endif
@endsection
