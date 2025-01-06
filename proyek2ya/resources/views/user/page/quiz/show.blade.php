@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $question->question }}</h1>
    <form action="{{ route('user.page.quiz.submit', $question->id) }}" method="POST">
        @csrf
        <div class="form-group">
            @foreach($question->answers as $answer)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[]" value="{{ $answer->answer }}">
                <label class="form-check-label">{{ $answer->answer }}</label>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit Quiz</button>
    </form>
</div>
@endsection
