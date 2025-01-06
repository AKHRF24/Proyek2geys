@extends('admin.layouts.index')

@section('content')
<h1>Create Question</h1>
<form action="{{ route('admin.page.question.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="question">Question</label>
        <input type="text" name="question" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="answers">Answers</label>
        <input class="mt-4" type="text" name="answers[]" class="form-control" required>
        <input class="mt-4" type="text" name="answers[]" class="form-control" required>
        <input class="mt-4" type="text" name="answers[]" class="form-control" required>
        <input class="mt-4" type="text" name="answers[]" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="correct_answer">Correct Answer</label>
        <input type="text" name="correct_answer" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
