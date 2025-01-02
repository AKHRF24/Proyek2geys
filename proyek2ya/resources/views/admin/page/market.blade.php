@extends('admin.layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 class="mb-4">Product List</h1>
            <a href="{{ route('admin.page.product.create') }}" class="btn btn-primary mb-3">Create New Product</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Point</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $products)
                        <tr>
                            <td>{{ $products->id }}</td>
                            <td>{{ $products->name }}</td>
                            <td>{{ $products->point }}</td>
                            <td>{{ $products->description }}</td>
                            <td>
                                <a href="{{ route('admin.page.product.edit', $products->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.page.product.destroy', $products->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
