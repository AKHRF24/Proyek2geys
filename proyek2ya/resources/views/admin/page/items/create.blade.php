@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Create Product</h1>
    <form action="{{ route('admin.page.items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_product" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="nama_product" name="nama_product" required>
        </div>
        <div class="mb-3">
            <label for="point" class="form-label">Point</label>
            <input type="number" class="form-control" id="point" name="point" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
