@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1 class="mb-4">Questions Management</h1>
    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Add New Question</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Correct Answer</th>
                <th>Points</th>
                {{-- <th>Validated</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $question->question }}</td>
                <td>{{ $question->correct_answer }}</td>
                <td>{{ $question->points }}</td>
                {{-- <td>{{ $question->is_validated ? 'Yes' : 'No' }}</td> --}}
                <td>
                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $questions->links() }}
</div>
@endsection
