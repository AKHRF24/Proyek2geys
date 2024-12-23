@extends('user.layouts.index')

@section('content')
<div class="container mt-4">
    <div class="product-card">
        <div class="card-header">
            <img src="" alt="Product Image">
        </div>
        <div class="card-body">
            <p>Produk</p>
        </div>
        <div class="card-footer">
            <p class="m-0" style="font-size: 16px; font-weight:600;">PT</p>
            <p class="m-0" style="font-size: 16px; font-weight:600;">15000</p>
            <form>
                <input type="hidden">
                <button type="submit" class="btn btn-outline-primary">EXCHANCE</button>
            </form>
        </div>
    </div>
</div>
@endsection
