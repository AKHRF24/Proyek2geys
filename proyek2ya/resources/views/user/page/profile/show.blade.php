@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1>Your Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan informasi pengguna -->
    <div class="mb-4">
        <h3>Profile Details</h3>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Points:</strong> {{ $user->points }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <a href="{{ route('user.page.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
