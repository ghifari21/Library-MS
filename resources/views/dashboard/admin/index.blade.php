@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Dashboard</h2>

<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Member</h3>
                    <h5 class="card-text mt-3">{{ $members->count() }} Active members</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/members" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Bibliography</h3>
                    <h5 class="card-text mt-3">{{ $bibliographies->count() }} Bibliographies</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/bibliographies" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Collection</h3>
                    <h5 class="card-text mt-3">{{ $collections->count() }} Collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/bibliographies" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Author</h3>
                    <h5 class="card-text mt-3">{{ $authors->count() }} Authors</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/authors" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Publisher</h3>
                    <h5 class="card-text mt-3">{{ $publishers->count() }} Publishers</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/publishers" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Category</h3>
                    <h5 class="card-text mt-3">{{ $categories->count() }} Categories</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/categories" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Transaction</h3>
                    <h5 class="card-text mt-3">{{ $transactions->count() }} Transactions</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Request to Borrow</h3>
                    <h5 class="card-text mt-3">{{ $requests->count() }} Requests to borrow</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/requests" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Borrowed</h3>
                    <h5 class="card-text mt-3">{{ $borrowed->count() }} Borrowed collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions?status=Borrowed" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Returned</h3>
                    <h5 class="card-text mt-3">{{ $returned->count() }} Returned collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions?status=Returned" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Exceeded Deadline</h3>
                    <h5 class="card-text mt-3">{{ $exceed->count() }} Collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions?needToReturn=1" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
