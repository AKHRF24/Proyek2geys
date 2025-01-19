@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1>Answer the Question</h1>
    <p><strong>Question:</strong> {{ $question->question }}</p>
    <form action="{{ route('user.page.submit', $question->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Select Your Answer:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer" value="A" id="optionA" required>
                <label class="form-check-label" for="optionA">
                    A. {{ $question->option_a }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer" value="B" id="optionB" required>
                <label class="form-check-label" for="optionB">
                    B. {{ $question->option_b }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer" value="C" id="optionC" required>
                <label class="form-check-label" for="optionC">
                    C. {{ $question->option_c }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer" value="D" id="optionD" required>
                <label class="form-check-label" for="optionD">
                    D. {{ $question->option_d }}
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Submit Answer</button>
    </form>
</div>
@endsection
