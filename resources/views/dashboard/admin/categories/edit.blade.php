@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/categories">Categories</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/categories/{{ $category->category_code }}">{{ $category->name }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Edit Category Form</h2>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/categories/{{ $category->category_code }}" method="POST">
                @method('put')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name', $category->name) }}">
                    <label for="name">Name</label>
                    @error('name')
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
