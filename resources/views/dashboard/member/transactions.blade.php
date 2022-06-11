@extends('dashboard.layouts.main')

@section('container')
<h2 class="text-center my-3">Transactions</h2>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-12 text-end">
        <a class="btn btn-primary mb-3 ms-0" data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
            <span data-feather="filter"></span> Filter
        </a>
    </div>
</div>
<div class="collapse mb-3" id="filters">
    <div class="card card-body">
        <form action="/dashboard/transactions/{{ auth()->user()->username }}" method="get">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="status" aria-label="Floating label select example" name="status">
                            <option selected value="">Select transaction status</option>
                            <option value="Borrowed" {{ request('status') === 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="Returned" {{ request('status') === 'Returned' ? 'selected' : '' }}>Returned</option>
                            <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <label for="author">Status</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="duration" aria-label="Floating label select example" name="duration">
                            <option selected value="">Select borrowing duration</option>
                            <option value="3" {{ request('duration') === '3' ? 'selected' : '' }}>3 Days</option>
                            <option value="7" {{ request('duration') === '7' ? 'selected' : '' }}>7 Days</option>
                            <option value="14" {{ request('duration') === '14' ? 'selected' : '' }}>14 Days</option>
                        </select>
                        <label for="author">Duration</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="borrowed_date" id="borrowed_date" value="{{ request('borrowed_date') }}">
                        <label for="floatingInput">Borrowed Date</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="return_deadline" id="return_deadline" value="{{ request('return_deadline') }}">
                        <label for="floatingInput">Return Deadline</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="returned_date" id="returned_date" value="{{ request('return_date') }}">
                        <label for="floatingInput">Returned Date</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@if ($circulations->count())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Transaction Code</th>
                <th scope="col">Bibliography Title</th>
                <th scope="col">Collection Code</th>
                <th scope="col">Borrowed Date</th>
                <th scope="col">Returned Date</th>
                <th scope="col">Duration</th>
                <th scope="col">Return Deadline</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($circulations as $circulation)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $circulation->transaction_code }}</td>
                <td>{{ $circulation->collection->bibliography->title }}</td>
                <td>{{ $circulation->collection->collection_code }}</td>
                <td>{{ \Carbon\Carbon::parse($circulation->borrowed_date)->format('d/m/Y') }}</td>
                <td>
                    @if ($circulation->returned_date)
                        {{ \Carbon\Carbon::parse($circulation->returned_date)->format('d/m/Y') }}
                    @else
                        Not returned yet
                    @endif
                </td>
                <td>{{ $circulation->duration }}</td>
                <td>{{ \Carbon\Carbon::parse($circulation->return_deadline)->format('d/m/Y') }}</td>
                <td>{{ $circulation->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-end">
    {{ $circulations->links() }}
</div>
@else
<p class="text-center mb-3 fs-5">No transaction found.</p>
@endif
@endsection
