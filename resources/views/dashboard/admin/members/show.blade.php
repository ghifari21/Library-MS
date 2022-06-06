@extends('dashboard.layouts.main')

@section('container')
<nav class="mt-3" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/dashboard/members">Members</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $member->user->name }}</li>
  </ol>
</nav>
<h2 class="text-center mb-3">Member</h2>
<div class="row mt-5">
    <div class="col-md-2 mb-3">
        @if ($member->photo)
            <img class="img-thumbnail rounded-circle" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->user->name }}">
        @else
            <img class="img-thumbnail rounded-circle" src="/img/blank-profile-picture.png" alt="blank">
        @endif
    </div>
    <div class="col-md-10 mb-3">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 15%;">Member Code</th>
                            <td>: {{ $member->member_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>: {{ $member->user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">NIK</th>
                            <td>: {{ $member->nik }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Username</th>
                            <td>: {{ $member->user->username }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>: {{ $member->user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td>: {{ $member->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td>: {{ $member->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-md-12">
        <h2 class="text-center mb-3">Transaction History</h2>
        @if ($circulations->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Transaction Code</th>
                        <th scope="col">Book Title</th>
                        <th scope="col">Borrowed Date</th>
                        <th scope="col">Returned Date</th>
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
                        <td>{{ $circulation->borrowed_date }}</td>
                        <td>
                        @if ($circulation->returned_date)
                            {{ $circulation->returned_date }}
                        @else
                            NULL
                        @endif
                        </td>
                        <td>{{ $circulation->return_deadline }}</td>
                        <td>
                            @if ($circulation->status === "borrowed")
                                Borrowed
                            @elseif ($circulation->status === "returned")
                                Returned
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center mb-3 fs-5">No Transaction found.</p>
        @endif
    </div>
</div>
@endsection
