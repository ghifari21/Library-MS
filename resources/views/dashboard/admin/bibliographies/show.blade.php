@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies">Bibliographies</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $bibliography->title }}</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Bibliography</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row mt-5">
    <div class="col-md-2 mb-3">
        @if ($bibliography->photo)
            <img class="img-thumbnail" src="{{ asset('storage/' . $bibliography->photo) }}" alt="{{ $bibliography->title }}">
        @else
            <img class="img-thumbnail" src="/img/blank-cover.png" alt="blank">
        @endif
    </div>
    <div class="col-md-10 mb-3">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 15%;">Title</th>
                            <td>: {{ $bibliography->title }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Book Code</th>
                            <td>: {{ $bibliography->book_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">ISBN</th>
                            <td>: {{ $bibliography->isbn }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Author</th>
                            <td>: {{ $bibliography->author->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Publisher</th>
                            <td>: {{ $bibliography->publisher->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Category</th>
                            <td>: {{ $bibliography->category->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Language</th>
                            <td>: {{ $bibliography->language }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Published Year</th>
                            <td>: {{ $bibliography->published_year }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Stock</th>
                            <td>: {{ $bibliography->stock }}</td>
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
        <h2 class="text-center mb-3">Collections</h2>
        <a class="btn btn-primary mb-3" href="/dashboard/bibliographies/{{ $bibliography->book_code }}/collections/create"><span data-feather="plus"></span> Add Collection</a>
        @if ($collections->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 10%;">Collection Code</th>
                        <th scope="col" style="width: 25%;">Registry Number</th>
                        <th scope="col">Stored Shelf</th>
                        <th scope="col">Condition</th>
                        <th scope="col" style="width: 10%;">Availability</th>
                        <th scope="col" style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($collections as $collection)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $collection->collection_code }}</td>
                        <td>{{ $collection->registry_number }}</td>
                        <td>{{ $collection->stored_shelf }}</td>
                        <td>{{ $collection->condition }}</td>
                        <td>
                            @if ($collection->is_available)
                            <a href="/dashboard/transactions/{{ $collection->collection_code }}/create" class="btn btn-success">Available</a>
                            @else
                            <button type="button" class="btn btn-danger">Unavailable</button>
                            @endif
                        </td>
                        <td>
                            <a class="badge bg-warning" href="/dashboard/collections/{{ $collection->collection_code }}/edit"><span data-feather="edit"></span></a>
                            <form action="/dashboard/collections/{{ $collection->collection_code }}" method="post" class="d-inline">
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
        <p class="text-center mb-3 fs-5">No collection found.</p>
        @endif
    </div>
</div>
@endsection
