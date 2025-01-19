<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // List all questions for admin
    public function index()
    {
        $questions = Questions::paginate(10);
        return view('admin.page.question.index', compact('questions'));
    }

    // Show create question form
    public function create()
    {
        return view('admin.page.question.create');
    }

    // Store a new question
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'points' => 'required|integer|min:1',
        ]);

        Questions::create([
            'question' => $validated['question'],
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
            'correct_answer' => $validated['correct_answer'],
            'points' => $validated['points'],
            'user_id' => auth()->id(),
            'is_validated' => false, // Default to not validated
        ]);

        return redirect()->route('questions.index')->with('success', 'Question created successfully!');
    }

    // Show the question for admin to verify answers
    public function show(Questions $question)
    {
        $users = User::all(); // Ambil semua pengguna untuk simulasi
        return view('admin.page.question.show', compact('question', 'users'));
    }

    // Admin verifies the answer
    public function verifyAnswer(Request $request, $userAnswerId)
    {
        $userAnswer = UserAnswer::findOrFail($userAnswerId);

        $validated = $request->validate([
            'is_correct' => 'required|boolean',
            'status_question' => 'required|in:approved,rejected',
        ]);

        $userAnswer->update([
            'is_correct' => $validated['is_correct'],
            'status_question' => $validated['status_question'],
        ]);

        if ($validated['is_correct'] && $validated['status_question'] === 'approved') {
            if ($userAnswer->user && $userAnswer->question) {
                $userAnswer->user->increment('points', $userAnswer->question->points);
            } else {
                return redirect()->back()->withErrors(['error' => 'User or Question not found for this answer.']);
            }
        }

        return redirect()->route('questions.show', $userAnswer->question_id)
            ->with('success', 'Answer verified successfully.');
    }
    public function edit(Questions $question)
    {
        return view('admin.page.question.edit', compact('question'));
    }
    public function update(Request $request, Questions $question)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
            'points' => 'required|integer|min:1',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'Question updated successfully!');
    }
    public function destroy(Questions $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully!');
    }

    //user
    public function showAnswerForm(Questions $question)
    {
        return view('user.page.answer', compact('question'));
    }

    public function userIndex()
    {
        $questions = Questions::paginate(10);
        return view('user.page.index', compact('questions'));
    }
    public function submitAnswer(Request $request, Questions $question)
    {
        $validated = $request->validate([
            'answer' => 'required|in:A,B,C,D',
        ]);

        // Simpan jawaban pengguna
        $question->userAnswers()->create([
            'user_id' => auth()->id(),
            'answer' => $validated['answer'],
            'is_correct' => $validated['answer'] === $question->correct_answer,
            'status_question' => 'pending', // Menunggu validasi admin
        ]);

        return redirect()->route('user.page.index')
            ->with('success', 'Your answer has been submitted and is awaiting admin validation.');
    }

}
