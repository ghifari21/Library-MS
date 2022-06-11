@extends('layouts.main')

@section('container')
<h2 class="text-center">Categories</h2>
<div class="container-fluid mx-auto my-5 col-lg-6">
    <form action="/categories">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit" id="search"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
</div>
<div class="row mx-auto mt-5">
@if ($categories->count())
    @foreach ($categories as $category)
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <a class="card-title fs-4 text-dark text-decoration-none" href="/bibliographies?category={{ $category->category_code }}">{{ $category->name }}</a>
                </div>
            </div>
        </div>
    @endforeach
<div class="d-flex justify-content-end">
    {{ $categories->links() }}
</div>
@else
    <p class="text-center mb-3 fs-5">No category found.</p>
@endif
</div>

@endsection
