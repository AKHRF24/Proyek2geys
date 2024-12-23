@extends('user.layouts.index')

@section('content')
<div class="card"
style="margin-top: 5%; margin-bottom: 1%;
       margin-left: 10%; margin-right: 10%;
       padding: 50px; background-color: rgb(237, 236, 234);
       border-style: groove">
       {{--  --}}
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
       {{--  --}}
       <div class="card p-5"
       style="margin-left: 10%; margin-right: 10%;
              padding: 50px;
              border-style: groove">
              <p>card ini untuk mengisi data seperti poin yang dimiliki, total quiz yang dikerjakan, poin yang terpakai</p>
       </div>
</div>
@endsection
