<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use App\Models\Answers;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Questions::with('answers')->get();
        return view('admin.page.question.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.page.question.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required|string',
        ]);

        $question = Questions::create(['question' => $validated['question'], 'correct_answer' => $validated['correct_answer']]);

        foreach ($validated['answers'] as $answer) {
            $question->answers()->create([
                'answer' => $answer,
                'is_correct' => $answer === $validated['correct_answer'],
            ]);
        }

        return redirect()->route('admin.page.question.index')->with('success', 'Question created successfully!');
    }

    public function edit(Questions $question)
    {
        return view('admin.page.question.edit', compact('question'));
    }

    public function update(Request $request, Questions $question)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answers.*' => 'required|string|max:255',
            'correct_answer' => 'required|string',
        ]);

        $question->update(['question' => $validated['question'], 'correct_answer' => $validated['correct_answer']]);
        $question->answers()->delete();

        foreach ($validated['answers'] as $answer) {
            $question->answers()->create([
                'answer' => $answer,
                'is_correct' => $answer === $validated['correct_answer'],
            ]);
        }

        return redirect()->route('admin.page.question.index')->with('success', 'Question updated successfully!');
    }

    public function destroy(Questions $question)
    {
        $question->delete();
        return redirect()->route('admin.page.question.index')->with('success', 'Question deleted successfully!');
    }
}
