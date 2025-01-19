@extends('user.layouts.index')

@section('content')
<div class="container">
    <h1>Questions</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $question->question }}</td>
                <td>
                    <a href="{{ route('user.page.answer', $question->id) }}" class="btn btn-primary">Answer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $questions->links() }}
</div>
@endsection
