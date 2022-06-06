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
<a class="btn btn-primary mb-3" href="/dashboard/publishers/create"><span data-feather="plus"></span> Publishers Author</a>
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
@else
<p class="text-center mb-3 fs-5">No publisher found.</p>
@endif
@endsection
