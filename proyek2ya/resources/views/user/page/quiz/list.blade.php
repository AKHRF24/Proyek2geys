@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Quizzes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($questions->isEmpty())
        <p>No quizzes available at the moment. Please check back later!</p>
    @else
        <div class="row">
            @foreach($questions as $question)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quiz {{ $loop->iteration }}</h5>
                        <p class="card-text">{{ $question->question }}</p>
                        <a href="{{ route('user.page.quiz.show', $question->id) }}" class="btn btn-primary">Take Quiz</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
