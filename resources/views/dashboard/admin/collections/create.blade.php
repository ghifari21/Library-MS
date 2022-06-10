@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies">Bibliographies</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies/{{ $bibliography->book_code }}">{{ $bibliography->title }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Collection</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Add Collection Form</h2>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/bibliographies/{{ $bibliography->book_code }}/collections" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="stored_shelf" class="form-control rounded-top @error('stored_shelf') is-invalid @enderror" id="stored_shelf" placeholder="stored_shelf" required value="{{ old('stored_shelf') }}">
                    <label for="stored_shelf">Stored Shelf</label>
                    @error('stored_shelf')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                        <option selected disabled>Open this select menu</option>
                        <option value="Fine" {{ old('condition') === 'Fine' ? 'selected' : '' }}>Fine</option>
                        <option value="Near Fine" {{ old('condition') === 'Near Fine' ? 'selected' : '' }}>Near Fine</option>
                        <option value="Very Good" {{ old('condition') === 'Very Good' ? 'selected' : '' }}>Very Good</option>
                        <option value="Good" {{ old('condition') === 'Good' ? 'selected' : '' }}>Good</option>
                        <option value="Fair" {{ old('condition') === 'Fair' ? 'selected' : '' }}>Fair</option>
                        <option value="Poor" {{ old('condition') === 'Poor' ? 'selected' : '' }}>Poor</option>
                    </select>
                    <label for="condition">Condition</label>
                    @error('condition')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
            </form>
        </main>
    </div>
</div>
@endsection
