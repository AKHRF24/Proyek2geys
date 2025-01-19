@extends('admin.layouts.index')

@section('content')
<div class="container">
    <h1>Verify Answers for Question: {{ $question->question }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Answer</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($question->userAnswers as $answer)
            <tr>
                <td>{{ $answer->user->name }}</td>
                <td>{{ $answer->answer }}</td>
                <td>{{ ucfirst($answer->status) }}</td>
                <td>
                    @if($answer->status === 'pending')
                    <form action="{{ route('questions.verify', $answer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_correct" value="1">
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('questions.verify', $answer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="is_correct" value="0">
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                    @else
                    <span>{{ ucfirst($answer->status) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
