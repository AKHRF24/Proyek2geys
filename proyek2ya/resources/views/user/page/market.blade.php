@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Market</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>No products available at the moment.</strong>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('images/default.png') }}"
                         class="card-img-top"
                         alt="{{ $product->nama_product }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_product }}</h5>
                        <p class="card-text">{{ $product->description ?? 'No description' }}</p>
                        <p><strong>Point: </strong>{{ $product->point }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('user.page.transaction.redeem') }}" method="get">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantity" min="1" max="{{ $product->quantity - $product->quantity_out }}" required>
                            <button type="submit" class="btn btn-success">Redeem</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
