@extends('admin.layouts.index')

@section('content')
<h1>Questions</h1>
<a href="{{ route('admin.page.question.create') }}" class="btn btn-primary">Create New Question</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Correct Answer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
        <tr>
            <td>{{ $question->id }}</td>
            <td>{{ $question->question }}</td>
            <td>
                <ul>
                    @foreach($question->answers as $answer)
                    <li>{{ $answer->answer }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $question->correct_answer }}</td>
            <td>
                <a href="{{ route('admin.page.question.edit', $question) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.page.question.destroy', $question) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
