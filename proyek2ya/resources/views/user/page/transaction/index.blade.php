@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">My Transactions</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($transactions->isEmpty())
    <div class="alert alert-warning text-center">
        <strong>You have no transactions yet.</strong>
    </div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction Code</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Points</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->code_transaksi }}</td>
                <td>{{ $transaction->product->nama_product }}</td>
                <td>{{ $transaction->total_qty }}</td>
                <td>{{ $transaction->total_harga }}</td>
                {{-- <td>{{ $transaction->ekspedisi }}</td>
                <td>{{ $transaction->bayar }}</td> --}}
                <td>{{ ucfirst($transaction->status_transaction) }}</td>
                <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
