@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Edit Question</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea id="question" name="question" class="form-control" rows="3" required>{{ $question->question }}</textarea>
        </div>

        <div class="mb-3">
            <label for="option_a" class="form-label">Option A</label>
            <input type="text" id="option_a" name="option_a" class="form-control" value="{{ $question->option_a }}" required>
        </div>

        <div class="mb-3">
            <label for="option_b" class="form-label">Option B</label>
            <input type="text" id="option_b" name="option_b" class="form-control" value="{{ $question->option_b }}" required>
        </div>

        <div class="mb-3">
            <label for="option_c" class="form-label">Option C</label>
            <input type="text" id="option_c" name="option_c" class="form-control" value="{{ $question->option_c }}" required>
        </div>

        <div class="mb-3">
            <label for="option_d" class="form-label">Option D</label>
            <input type="text" id="option_d" name="option_d" class="form-control" value="{{ $question->option_d }}" required>
        </div>

        <div class="mb-3">
            <label for="correct_answer" class="form-label">Correct Answer</label>
            <select id="correct_answer" name="correct_answer" class="form-select" required>
                <option value="A" {{ $question->correct_answer === 'A' ? 'selected' : '' }}>Option A</option>
                <option value="B" {{ $question->correct_answer === 'B' ? 'selected' : '' }}>Option B</option>
                <option value="C" {{ $question->correct_answer === 'C' ? 'selected' : '' }}>Option C</option>
                <option value="D" {{ $question->correct_answer === 'D' ? 'selected' : '' }}>Option D</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="points" class="form-label">Points</label>
            <input type="number" id="points" name="points" class="form-control" value="{{ $question->points }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
@endsection
