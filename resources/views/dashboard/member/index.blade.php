@extends('dashboard.layouts.main')

@section('container')
<h2 class="text-center my-3">Welcome, {{ auth()->user()->name }}</h2>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Total Transaction</h3>
                    <h5 class="card-text mt-3">{{ $circulations->count() }} Transactions</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions/{{ auth()->user()->username }}" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Currently Borrowing</h3>
                    <h5 class="card-text mt-3">{{ $borrowed->count() }} Collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions/{{ auth()->user()->username }}?status=Borrowed" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body text-center bg-secondary text-light">
                    <h3 class="card-title">Need To Return</h3>
                    <h5 class="card-text mt-3">{{ $return->count() }} Collections</h5>
                    <div class="container-fluid text-start mt-4">
                        <a href="/dashboard/transactions/{{ auth()->user()->username }}?needToReturn=1" class="btn btn-primary">See more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
