@extends('admin.layouts.index')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Products</h1>
    <a href="{{ route('admin.page.items.create') }}" class="btn btn-primary">Add Product</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<h2 class="mt-4">Products</h2>
<div class="table-responsive mb-5">
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nama Product</th>
                <th>Point</th>
                <th>Quantity</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ $product->foto ? asset('storage/' . $product->foto) : asset('images/default.png') }}"
                         alt="{{ $product->nama_product }}"
                         class="img-thumbnail" style="width: 80px; height: 80px;">
                </td>
                <td>{{ $product->nama_product }}</td>
                <td>{{ $product->point }}</td>
                <td>{{ $product->quantity }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.page.items.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.page.items.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $products->links() }}
@endsection
