@extends('layouts.main')

@section('container')
<h2 class="text-center">Publishers</h2>
<div class="container-fluid mx-auto my-5 col-lg-6">
    <form action="/publishers">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit" id="search"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
</div>
<div class="row mx-auto mt-5">
@if ($publishers->count())
    @foreach ($publishers as $publisher)
        <div class="col-md-3 mb-3" style="width: 20%">
            <div class="card shadow-sm text-center">
                <a href="/bibliographies?publisher={{ $publisher->publisher_code }}">
                    <img src="
                    @if ($publisher->photo)
                        {{ asset('storage/' . $publisher->photo) }}
                    @else
                        /img/blank-profile-picture.png
                    @endif
                    " alt="{{ $publisher->name }}" class="card-img-top">
                </a>
                <div class="card-body">
                    <a class="card-title fs-4 text-dark text-decoration-none" href="/bibliographies?publisher={{ $publisher->publisher_code }}">{{ $publisher->name }}</a>
                </div>
            </div>
        </div>
    @endforeach
<div class="d-flex justify-content-end">
    {{ $publishers->links() }}
</div>
@else
    <p class="text-center mb-3 fs-5">No publisher found.</p>
@endif
</div>

@endsection
