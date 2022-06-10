@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies">Bibliographies</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies/{{ $collection->bibliography->book_code }}">{{ $collection->bibliography->title }}</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/bibliographies/{{ $collection->bibliography->book_code }}">{{ $collection->collection_code }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Borrow</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Borrowing Form</h2>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <main class="form-registration w-100 mt-3 mb-5">
            <form action="/dashboard/transactions/{{ $collection->collection_code }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="member_code" class="form-control rounded-top @error('member_code') is-invalid @enderror" id="member_code" placeholder="member_code" required value="{{ old('member_code') }}">
                    <label for="member_code">Member Code</label>
                    @error('member_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" name="borrowed_date" class="form-control rounded-top @error('borrowed_date') is-invalid @enderror" id="borrowed_date" placeholder="borrowed_date" required value="{{ old('borrowed_date') }}">
                            <label for="borrowed_date">Borrowed Date</label>
                            @error('borrowed_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('duration') is-invalid @enderror" id="duration" name="duration" required>
                                <option selected disabled>Open this select menu</option>
                                <option value="3" {{ old('duration') === '3' ? 'selected' : '' }}>3 Days</option>
                                <option value="7" {{ old('duration') === '7' ? 'selected' : '' }}>7 Days</option>
                                <option value="14" {{ old('duration') === '14' ? 'selected' : '' }}>14 Days</option>
                            </select>
                            <label for="duration">Duration</label>
                            @error('duration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
            </form>
        </main>
    </div>
</div>
@endsection
