@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies">Bibliographies</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies/{{ $bibliography->book_code }}">{{ $bibliography->title }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Edit Bibliography Form</h2>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/bibliographies/{{ $bibliography->book_code }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control rounded-top @error('title') is-invalid @enderror" id="title" placeholder="title" required value="{{ old('title', $bibliography->title) }}">
                    <label for="title">Title</label>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" aria-label="Floating label select example" name="author_id" required>
                                <option selected value="">Select author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $bibliography->author_id) === $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            <label for="author_id">Author</label>
                            @error('author_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('publisher_id') is-invalid @enderror" id="publisher_id" aria-label="Floating label select example" name="publisher_id" required>
                                <option selected value="">Select publisher</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $bibliography->publisher_id) === $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            <label for="publisher_id">Publisher</label>
                            @error('publisher_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" aria-label="Floating label select example" name="category_id" required>
                                <option selected value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $bibliography->category_id) === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="category_id">Category</label>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" placeholder="ISBN" value="{{ old('isbn', $bibliography->isbn) }}" required>
                            <label for="isbn">ISBN</label>
                            @error('isbn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('language') is-invalid @enderror" id="language" aria-label="Floating label select example" name="language" required>
                                <option selected value="">Select language</option>
                                <option value="Indonesia" {{ old('language', $bibliography->language) === 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="English" {{ old('language', $bibliography->language) === 'English' ? 'selected' : '' }}>English</option>
                            </select>
                            <label for="language">Language</label>
                            @error('language')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('published_year') is-invalid @enderror" id="year" name="published_year" placeholder="Published Year" value="{{ old('published_year', $bibliography->published_year) }}" required>
                            <label for="year">Published Year</label>
                            @error('published_year')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Cover</label>
                    <input type="hidden" name="old_photo" value="{{ $bibliography->photo }}">
                    <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" onchange="previewImage()">
                    @if ($bibliography->photo)
                        <img class="img-preview img-thumbnail my-3 col-sm-3" src="{{ asset('storage/' . $bibliography->photo) }}">
                    @else
                        <img class="img-preview img-thumbnail my-3 col-sm-3 d-none">
                    @endif
                    @error('photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
            </form>
        </main>
    </div>
</div>
@endsection
