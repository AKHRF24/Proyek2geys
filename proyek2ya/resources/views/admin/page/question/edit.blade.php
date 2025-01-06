@extends('admin.layouts.index')

@section('content')
<h1>Edit Question</h1>
<form action="{{ route('admin.page.question.update', $question->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="question">Question</label>
        <input type="text" name="question" class="form-control" value="{{ $question->question }}" required>
    </div>
    <div class="form-group">
        <label for="answers">Answers</label>
        @foreach($question->answers as $answer)
            <input type="text" name="answers[]" class="form-control" value="{{ $answer->answer }}" required>
        @endforeach
    </div>
    <div class="form-group">
        <label for="correct_answer">Correct Answer</label>
        <input type="text" name="correct_answer" class="form-control" value="{{ $question->correct_answer }}" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
