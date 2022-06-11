@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Publishers</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Publishers</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary mb-3" href="/dashboard/publishers/create"><span data-feather="plus"></span> Add Publisher</a>
    </div>
    <div class="col-md-4 text-end">
        <form action="/dashboard/publishers" method="get" class="text-end">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search"><span data-feather="search"></span> Search</button>
            </div>
        </form>
    </div>
</div>
@if ($publishers->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="width: 15%">Publisher Code</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Last Updated</th>
                <th scope="col" style="width: 10%">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($publishers as $publisher)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $publisher->publisher_code }}</td>
                <td>{{ $publisher->name }}</td>
                <td>{{ $publisher->email }}</td>
                <td>{{ $publisher->phone }}</td>
                <td>{{ $publisher->updated_at->diffForHumans() }}</td>
                <td>
                    <a class="badge bg-info" href="/dashboard/publishers/{{ $publisher->publisher_code }}"><span data-feather="eye"></span></a>
                    <a class="badge bg-warning" href="/dashboard/publishers/{{ $publisher->publisher_code }}/edit"><span data-feather="edit"></span></a>
                    <form action="/dashboard/publishers/{{ $publisher->publisher_code }}" method="post" class="d-inline">
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
    {{ $publishers->links() }}
</div>
@else
<p class="text-center mb-3 fs-5">No publisher found.</p>
@endif
@endsection
