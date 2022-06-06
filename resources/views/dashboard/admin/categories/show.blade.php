@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/categories">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Category : {{ $category->name }}</h2>
<div class="row mt-3">
    <div class="col-md-12">
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
                        <th scope="col">Publisher</th>
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
                        <td>{{ $bibliography->publisher->name }}</td>
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
