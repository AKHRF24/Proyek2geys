<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::prefix('user/page')->middleware(['auth'])->group(function () {
    Route::get('market', [ProductController::class, 'userMarket'])->name('user.page.market');
    Route::get('/quiz', [QuestionController::class, 'listQuizzes'])->name('user.page.quiz.list');
    Route::get('/quiz/{question}', [QuestionController::class, 'show'])->name('user.page.quiz.show');
    Route::post('/quiz/{question}/submit', [QuestionController::class, 'submitQuiz'])->name('user.page.quiz.submit');
    Route::post('/quiz/results', [QuestionController::class, 'submitQuiz'])->name('user.page.quiz.results');

});
Auth::routes();

// Admin Routes
Route::prefix('admin/page')->middleware('auth')->group(function () {
    Route::get('dashboard', [Controller::class, 'index'])->name('admin.page.dashboard');

    Route::get('market', [ProductController::class, 'index'])->name('admin.page.market');
    Route::get('market/create', [ProductController::class, 'create'])->name('admin.page.items.create');
    Route::post('market', [ProductController::class, 'store'])->name('admin.page.items.store');
    Route::get('market/{product}/edit', [ProductController::class, 'edit'])->name('admin.page.items.edit');
    Route::put('market/{product}', [ProductController::class, 'update'])->name('admin.page.items.update');
    Route::delete('market/{product}', [ProductController::class, 'destroy'])->name('admin.page.items.destroy');

    Route::get('question', [QuestionController::class, 'index'])->name('admin.page.question.index');
    Route::get('question/create', [QuestionController::class, 'create'])->name('admin.page.question.create');
    Route::post('question', [QuestionController::class, 'store'])->name('admin.page.question.store');
    Route::get('question/{question}/edit', [QuestionController::class, 'edit'])->name('admin.page.question.edit');
    Route::put('question/{question}', [QuestionController::class, 'update'])->name('admin.page.question.update');
    Route::delete('question/{question}', [QuestionController::class, 'destroy'])->name('admin.page.question.destroy');
});



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



