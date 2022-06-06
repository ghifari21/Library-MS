@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Bibliographies</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Bibliographies</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary mb-3" href="/dashboard/bibliographies/create"><span data-feather="plus"></span> Add Bibliography</a>
    </div>
    <div class="col-md-6 text-end">
        <a class="btn btn-primary mb-3 ms-0" data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
            <span data-feather="filter"></span> Filter
        </a>
    </div>
</div>
<div class="collapse mb-3" id="filters">
    <div class="card card-body">
        <form action="/dashboard/bibliographies" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search"><span data-feather="search"></span> Search</button>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="author" aria-label="Floating label select example" name="author">
                            <option selected value="">Select author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->author_code }}" {{ request('author') === $author->author_code ? 'selected' : '' }}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <label for="author">Author</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="publisher" aria-label="Floating label select example" name="publisher">
                            <option selected value="">Select publisher</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->publisher_code }}" {{ request('publisher') === $publisher->publisher_code ? 'selected' : '' }}>{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        <label for="publisher">Publisher</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" id="category" aria-label="Floating label select example" name="category">
                            <option selected value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_code }}" {{ request('category') === $category->category_code ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="category">Category</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" id="language" aria-label="Floating label select example" name="language">
                            <option selected value="">Select language</option>
                            <option value="Indonesia" {{ request('language') === 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="English" {{ request('language') === 'English' ? 'selected' : '' }}>English</option>
                        </select>
                        <label for="language">Language</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="year" name="published_year" placeholder="name@example.com" value="{{ request('published_year') }}">
                        <label for="year">Published Year</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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
                <th scope="col">Category</th>
                <th scope="col">Published Year</th>
                <th scope="col">Language</th>
                <th scope="col">Stock</th>
                <th scope="col">Last Updated</th>
                <th scope="col">Action</th>
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
                <td>{{ $bibliography->category->name }}</td>
                <td>{{ $bibliography->published_year }}</td>
                <td>{{ $bibliography->language }}</td>
                <td>{{ $bibliography->stock }}</td>
                <td>{{ $bibliography->updated_at->diffForHumans() }}</td>
                <td>
                    <a class="badge bg-info" href="/dashboard/bibliographies/{{ $bibliography->book_code }}"><span data-feather="eye"></span></a>
                    <a class="badge bg-warning" href="/dashboard/bibliographies/{{ $bibliography->book_code }}/edit"><span data-feather="edit"></span></a>
                    <form action="/dashboard/bibliographies/{{ $bibliography->book_code }}" method="post" class="d-inline">
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
<p class="text-center mb-3 fs-5">No bibliography found.</p>
@endif
@endsection
