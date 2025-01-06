@extends('user.layouts.index')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1>Quiz Results</h1>
    <p>Your current points: <strong>{{ Auth::user()->points }}</strong></p>
    {{-- <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a> --}}
</div>
@endsection
