@extends('layouts.main')

@section('container')
<h2 class="text-center">Authors</h2>
<div class="container-fluid mx-auto my-5 col-lg-6">
    <form action="/authors">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit" id="search"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
</div>
<div class="row mx-auto mt-5">
@if ($authors->count())
    @foreach ($authors as $author)
        <div class="col-md-3 mb-3" style="width: 20%">
            <div class="card shadow-sm text-center">
                <a href="/bibliographies?author={{ $author->author_code }}">
                    <img src="
                    @if ($author->photo)
                        {{ asset('storage/' . $author->photo) }}
                    @else
                        /img/blank-profile-picture.png
                    @endif
                    " alt="{{ $author->name }}" class="card-img-top">
                </a>
                <div class="card-body">
                    <a class="card-title fs-4 text-dark text-decoration-none" href="/bibliographies?author={{ $author->author_code }}">{{ $author->name }}</a>
                </div>
            </div>
        </div>
    @endforeach
<div class="d-flex justify-content-end">
    {{ $authors->links() }}
</div>
@else
    <p class="text-center mb-3 fs-5">No author found.</p>
@endif
</div>

@endsection
