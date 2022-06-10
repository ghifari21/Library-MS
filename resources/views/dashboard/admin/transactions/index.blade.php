@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Transactions</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-12 text-end">
        <a class="btn btn-primary mb-3 ms-0" data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
            <span data-feather="filter"></span> Filter
        </a>
    </div>
</div>
<div class="collapse mb-3" id="filters">
    <div class="card card-body">
        <form action="/dashboard/transactions" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit" id="search"><span data-feather="search"></span> Search</button>
            </div>
            {{-- <div class="row">
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
            </div> --}}
        </form>
    </div>
</div>
@if ($circulations->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Transaction Code</th>
                <th scope="col">Member Name</th>
                <th scope="col">Bibliography Title</th>
                <th scope="col">Collection Code</th>
                <th scope="col">Borrowed Date</th>
                <th scope="col">Returned Date</th>
                <th scope="col">Duration</th>
                <th scope="col">Return Deadline</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($circulations as $circulation)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $circulation->transaction_code }}</td>
                <td>{{ $circulation->member->user->name }}</td>
                <td>{{ $circulation->collection->bibliography->title }}</td>
                <td>{{ $circulation->collection->collection_code }}</td>
                <td>{{ \Carbon\Carbon::parse($circulation->borrowed_date)->format('d/m/Y') }}</td>
                <td>
                    @if ($circulation->returned_date)
                        {{ \Carbon\Carbon::parse($circulation->returned_date)->format('d/m/Y') }}
                    @else
                        Not returned yet
                    @endif
                </td>
                <td>{{ $circulation->duration }}</td>
                <td>{{ \Carbon\Carbon::parse($circulation->return_deadline)->format('d/m/Y') }}</td>
                <td>{{ $circulation->status }}</td>
                <td>
                    <a class="badge bg-info" href="/dashboard/transactions/{{ $circulation->transaction_code }}"><span data-feather="eye"></span></a>
                    <form action="/dashboard/transactions/{{ $circulation->transaction_code }}" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="Returned">
                        <button class="badge bg-warning border-0" type="submit" onclick="return confirm('Are you sure?')"><span data-feather="edit"></span></button>
                    </form>
                    <form action="/dashboard/transactions/{{ $circulation->transaction_code }}" method="post" class="d-inline">
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
<p class="text-center mb-3 fs-5">No transaction found.</p>
@endif
@endsection
