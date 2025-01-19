@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('admin.page.items.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_barang" class="form-label">Product Code</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $product->kode_barang }}" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_product" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="nama_product" name="nama_product" value="{{ $product->nama_product }}" required>
        </div>
        <div class="mb-3">
            <label for="point" class="form-label">Point</label>
            <input type="number" class="form-control" id="point" name="point" value="{{ $product->point }}" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Product Image</label>
            @if($product->foto)
                <img src="{{ asset('storage/' . $product->foto) }}" alt="Product Image" width="100" class="mb-2">
            @endif
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
