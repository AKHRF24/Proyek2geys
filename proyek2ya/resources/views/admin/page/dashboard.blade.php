@extends('admin.layouts.index')
@section('content')

<div class="container mt-4">
    <h1 class="text-center">Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">Manage and add new products for users to redeem.</p>
                    <a href="{{ route('admin.page.market') }}" class="btn btn-light">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Questions</h5>
                    <p class="card-text">Create and manage quiz questions for user engagement.</p>
                    <a href="{{ route('questions.index') }}" class="btn btn-light">View Questions</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Transactions</h5>
                    <p class="card-text">Monitor and update transaction statuses.</p>
                    <a href="{{ route('admin.page.transactions') }}" class="btn btn-light">View Transactions</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
