@extends('layouts.main')

@section('container')
<div class="container-fluid mx-auto my-5 col-lg-6">
    <form action="/bibliographies">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit" id="search"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body text-center bg-secondary text-light">
                        <h3 class="card-title">Bibliography</h3>
                        <h5 class="card-text mt-3">{{ $bibliographies->count() }} Bibliographies</h5>
                        <div class="container-fluid text-start mt-4">
                            <a href="/bibliographies" class="btn btn-primary">See more</a>
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
