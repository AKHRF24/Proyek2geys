@extends('user.layouts.index')

@section('content')
{{-- <div class="card"
style="margin-top: 5%; margin-bottom: 1%;
       margin-left: 10%; margin-right: 10%;
       padding: 50px; background-color: rgb(237, 236, 234);
       border-style: groove">
       <div class="">
           <div class="container mb-5">
               <div class="row justify-content-center mt-5">
                   <div class="col-md-8">
                       <div class="card">
                           <div class="card-header">{{ __('Dashboard') }}</div>

                           <div class="card-body">
                               @if (session('status'))
                                   <div class="alert alert-success" role="alert">
                                       {{ session('status') }}
                                   </div>
                               @endif

                               {{ __('You are logged in!') }}
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        --}}
       <div class="container mt-4">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <p>Your Current Points: <strong>{{ Auth::user()->points }}</strong></p>
            <a href="{{ route('user.page.index') }}" class="btn btn-primary">Take a Quiz</a>
            <a href="{{ route('user.page.market') }}" class="btn btn-primary">Browse Market</a>
        </div>
@endsection
