@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Transaction Management</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($transactions->isEmpty())
    <div class="alert alert-warning text-center">
        <strong>No transactions available.</strong>
    </div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction Code</th>
                <th>User Name</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Points</th>
                <th>Address</th>
                <th>Phone</th>
                {{-- <th>Expedition</th> --}}
                {{-- <th>Payment</th> --}}
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->code_transaksi }}</td>
                <td>{{ $transaction->nama_user }}</td>
                <td>{{ $transaction->product->nama_product }}</td>
                <td>{{ $transaction->total_qty }}</td>
                <td>{{ $transaction->total_harga }}</td>
                <td>{{ $transaction->alamat }}</td>
                <td>{{ $transaction->no_tlp }}</td>
                {{-- <td>{{ $transaction->ekspedisi }}</td> --}}
                {{-- <td>{{ $transaction->bayar }}</td> --}}
                <td>
                    <span class="badge {{ $transaction->status_transaction == 'Paid' ? 'bg-success' : 'bg-warning' }}">
                        {{ ucfirst($transaction->status_transaction) }}
                    </span>
                </td>
                <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.transaction.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select mb-2">
                            <option value="Paid" {{ $transaction->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ $transaction->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $transactions->links() }}
    </div>
    @endif
</div>
@endsection
