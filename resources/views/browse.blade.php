@extends('layouts.main')

@section('container')
<h2 class="text-center">Bibliographies</h2>
<div class="row">
    <div class="col-md-6">
        <a class="btn btn-primary mb-3 ms-0" data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
            <span data-feather="filter"></span> Filter
        </a>
    </div>
</div>
<div class="collapse mb-3" id="filters">
    <div class="card card-body shadow-sm">
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
<div class="row mx-auto mt-5">
@if ($bibliographies->count())
    @foreach ($bibliographies as $bibliography)
        <div class="col-md-3 mb-3" style="width: 20%">
            <div class="card shadow-sm">
                <a href="/bibliographies/{{ $bibliography->book_code }}">
                    <img src="
                    @if ($bibliography->photo)
                        {{ asset('storage/' . $bibliography->photo) }}
                    @else
                        /img/blank-cover.png
                    @endif
                    " alt="{{ $bibliography->name }}" class="card-img-top">
                </a>
                <div class="card-body">
                    <a class="card-title text-center fs-4 text-dark text-decoration-none" href="/bibliographies/{{ $bibliography->book_code }}">{{ $bibliography->title }}</a>
                    <p class="card-text mt-3">Written by: <a class="text-decoration-none" href="/bibliographies?author={{ $bibliography->author->author_code }}">{{ $bibliography->author->name }}</a></p>
                </div>
            </div>
        </div>
    @endforeach
<div class="d-flex justify-content-end">
    {{ $bibliographies->links() }}
</div>
@else
    <p class="text-center mb-3 fs-5">No bibliography found.</p>
@endif
</div>

@endsection
