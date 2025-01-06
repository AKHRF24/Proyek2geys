@extends('admin.layouts.index')
@section('content')

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>1,234</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Total Points</h5>
                    <h2>45,678</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Transactions</h5>
                    <h2>567</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">System Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Point Multiplier</label>
                        <input type="number" class="form-control" value="1.0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Minimum Redemption Points</label>
                        <input type="number" class="form-control" value="100">
                    </div>
                    <button class="btn btn-primary">Save Settings</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Marketplace Management</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Add New Reward</label>
                        <input type="text" class="form-control mb-2" placeholder="Reward Name">
                        <input type="number" class="form-control mb-2" placeholder="Point Cost">
                        <button class="btn btn-success">Add Reward</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endsection
