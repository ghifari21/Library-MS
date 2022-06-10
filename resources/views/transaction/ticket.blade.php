@extends('transaction.layout.main')

@section('container')
        <div class="card mx-auto my-5 shadow-sm p-3" style="width: 80%;">
            <div class="card-body">
                <div class="text-center mb-5">
                    <h3 class="card-title">Transaction Ticket</h3>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3 text-center">
                        {!! $qrCode !!}
                    </div>
                    <div class="col-md-9 mb-3 table-responsive">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 15%;">Transaction Code</th>
                                    <td>: {{ $circulation->transaction_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Member Code</th>
                                    <td>: {{ $circulation->member->member_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Member Name</th>
                                    <td>: {{ $circulation->member->user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bibliography Title</th>
                                    <td>: {{ $circulation->collection->bibliography->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bibliography Code</th>
                                    <td>: {{ $circulation->collection->bibliography->book_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Collection Code</th>
                                    <td>: {{ $circulation->collection->collection_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Borrowed Date</th>
                                    <td>: {{ \Carbon\Carbon::parse($circulation->borrowed_date)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Duration</th>
                                    <td>: {{ $circulation->duration . ' days' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Return Deadline</th>
                                    <td>: {{ \Carbon\Carbon::parse($circulation->return_deadline)->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
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
