@extends('layouts.main')

@section('container')
    @include('partials.search')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center bg-secondary text-light">
                        <h3 class="card-title">Books</h3>
                        <h5 class="card-text mt-3">{{ $collections->count() }} Collections</h5>
                        <div class="container-fluid text-start mt-4">
                            <a href="/books" class="btn btn-primary">See more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center bg-secondary text-light">
                        <h3 class="card-title">Authors</h3>
                        <h5 class="card-text mt-3">{{ $authors->count() }} Authors</h5>
                        <div class="container-fluid text-start mt-4">
                            <a href="/authors" class="btn btn-primary">See more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center bg-secondary text-light">
                        <h3 class="card-title">Publishers</h3>
                        <h5 class="card-text mt-3">{{ $publishers->count() }} Publishers</h5>
                        <div class="container-fluid text-start mt-4">
                            <a href="/publishers" class="btn btn-primary">See more</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center bg-secondary text-light">
                        <h3 class="card-title">Categories</h3>
                        <h5 class="card-text mt-3">{{ $categories->count() }} Categories</h5>
                        <div class="container-fluid text-start mt-4">
                            <a href="/categories" class="btn btn-primary">See more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
