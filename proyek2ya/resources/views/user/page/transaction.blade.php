@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1>Your Transactions</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Points</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->product->nama_product }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>{{ $transaction->total_point }}</td>
                <td>{{ $transaction->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
