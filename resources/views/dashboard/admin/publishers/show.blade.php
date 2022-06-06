@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/publishers">Publishers</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $publisher->name }}</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Publisher</h2>
<div class="row mt-5">
    <div class="col-md-2 mb-3">
        @if ($publisher->photo)
            <img class="img-thumbnail rounded-circle" src="{{ asset('storage/' . $publisher->photo) }}" alt="{{ $publisher->name }}">
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
                            <th scope="row" style="width: 15%;">Publisher Code</th>
                            <td>: {{ $publisher->publisher_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>: {{ $publisher->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>: {{ $publisher->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td>: {{ $publisher->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td>: {{ $publisher->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-12">
        <h2 class="text-center mb-3">Bibliographies</h2>
        @if ($bibliographies->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Code</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Published Year</th>
                        <th scope="col">Language</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($bibliographies as $bibliography)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $bibliography->book_code }}</td>
                        <td>{{ $bibliography->isbn }}</td>
                        <td>{{ $bibliography->title }}</td>
                        <td>{{ $bibliography->author->name }}</td>
                        <td>{{ $bibliography->category->name }}</td>
                        <td>{{ $bibliography->published_year }}</td>
                        <td>{{ $bibliography->language }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center mb-3 fs-5">No bibliography found.</p>
        @endif
    </div>
</div>
@endsection
