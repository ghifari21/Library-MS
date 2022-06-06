@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/authors">Authors</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $author->name }}</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Author</h2>
<div class="row mt-5">
    <div class="col-md-2 mb-3">
        @if ($author->photo)
            <img class="img-thumbnail rounded-circle" src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}">
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
                            <th scope="row" style="width: 15%;">Author Code</th>
                            <td>: {{ $author->author_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>: {{ $author->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>: {{ $author->email }}</td>
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
                        <th scope="col">Publisher</th>
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
                        <td>{{ $bibliography->publisher->name }}</td>
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
