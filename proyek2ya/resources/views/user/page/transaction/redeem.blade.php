@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Transaction Form</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transaction.create') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" value="{{ $product->nama_product }}" disabled>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" value="{{ $quantity }}" disabled>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Address</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter your address" required>
        </div>

        <div class="mb-3">
            <label for="no_tlp" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="no_tlp" name="no_tlp" placeholder="Enter your phone number" required>
        </div>

        <div class="mb-3">
            <label for="ekspedisi" class="form-label">Expedition</label>
            <input type="text" class="form-control" id="ekspedisi" name="ekspedisi" placeholder="Enter expedition name" required>
        </div>

        <div class="mb-3">
            <label for="payment" class="form-label">Payment Method</label>
            <input type="text" class="form-control" id="payment" value="Point Payment" disabled>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit Transaction</button>
        </div>
    </form>
</div>
@endsection
