@extends('transaction.layout.main')

@section('container')
        <div class="card mx-auto my-5 shadow-sm p-3" style="width: 80%;">
            <div class="card-body">
                <div class="text-center mb-5">
                    <h3 class="card-title">Detail Transaction</h3>
                </div>
                <div class="row mt-5">
                    <div class="col-md-2 mb-3">
                        @if ($circulation->collection->bibliography->photo)
                            <img class="img-thumbnail" src="{{ asset('storage/' . $circulation->collection->bibliography->photo) }}" alt="{{ $circulation->collection->bibliography->title }}">
                        @else
                            <img class="img-thumbnail" src="/img/blank-cover.png" alt="blank">
                        @endif
                    </div>
                    <div class="col-md-10 mb-3">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 15%;">Title</th>
                                            <td>: {{ $circulation->collection->bibliography->title }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Book Code</th>
                                            <td>: {{ $circulation->collection->bibliography->book_code }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ISBN</th>
                                            <td>: {{ $circulation->collection->bibliography->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Author</th>
                                            <td>: {{ $circulation->collection->bibliography->author->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Publisher</th>
                                            <td>: {{ $circulation->collection->bibliography->publisher->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Category</th>
                                            <td>: {{ $circulation->collection->bibliography->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Language</th>
                                            <td>: {{ $circulation->collection->bibliography->language }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Published Year</th>
                                            <td>: {{ $circulation->collection->bibliography->published_year }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 20%;">Transaction Code</th>
                                            <td>: {{ $circulation->transaction_code }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Collection Code</th>
                                            <td>: {{ $circulation->collection->collection_code }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Registry Number</th>
                                            <td>: {{ $circulation->collection->registry_number }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Stored Shelf</th>
                                            <td>: {{ $circulation->collection->stored_shelf }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Borrowed Date</th>
                                            <td>: {{ \Carbon\Carbon::parse($circulation->borrowed_date)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Returned Date</th>
                                            <td>:
                                                @if ($circulation->returned_date)
                                                    {{ \Carbon\Carbon::parse($circulation->returned_date)->format('d/m/Y') }}
                                                @else
                                                    Not returned yet
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Duration</th>
                                            <td>: {{ $circulation->duration }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Return Deadline</th>
                                            <td>: {{ \Carbon\Carbon::parse($circulation->return_deadline)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Status</th>
                                            <td>:
                                                @if ($circulation->status === 'borrowed')
                                                    Borrowed
                                                @else
                                                    Returned
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-3">
                    <h2 class="text-center mb-3">Detail Member</h2>
                    <div class="col-md-2 mb-3">
                        @if ($circulation->member->photo)
                            <img class="img-thumbnail rounded-circle" src="{{ asset('storage/' . $circulation->member->photo) }}" alt="{{ $circulation->member->user->name }}">
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
                                            <td>: {{ $circulation->member->member_code }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>: {{ $circulation->member->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">NIK</th>
                                            <td>: {{ $circulation->member->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Username</th>
                                            <td>: {{ $circulation->member->user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>: {{ $circulation->member->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>: {{ $circulation->member->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>: {{ $circulation->member->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    @auth
                        <a href="/dashboard" class="btn btn-primary">Back</a>
                    @else
                        <a href="/home" class="btn btn-primary">Back</a>
                    @endauth
                </div>
            </div>
        </div>
@endsection
