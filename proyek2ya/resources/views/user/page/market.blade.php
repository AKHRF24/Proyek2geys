@extends('user.layouts.index')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4">
                    {{-- <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p><strong>Price:</strong> {{ $product->price }} points</p>
                        <a href="#" class="btn btn-primary">Redeem</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
