<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// User Routes
Route::prefix('user/page')->middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.page.dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('user.page.profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.page.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.page.profile.update');

    // Tampilkan formulir transaksi
    Route::get('/transaction/form', [TransactionController::class, 'transactionForm'])->name('user.page.transaction.redeem');
// Buat transaksi
    Route::post('/transaction/create', [TransactionController::class, 'createTransaction'])->name('transaction.create');
// Tampilkan daftar transaksi pengguna
    Route::get('/transactions', [TransactionController::class, 'index'])->name('user.page.transaction.index');
    // Route::post('/transaction/redeem', [TransactionController::class, 'redeem'])->name('user.transaction.redeem');
    // Market routes
    Route::get('market', [ProductController::class, 'userMarket'])->name('user.page.market');
    // Route::post('market/redeem', [TransactionController::class, 'redeem'])->name('user.page.market.redeem');
    // Question routes
    Route::get('/questions', [QuestionController::class, 'userIndex'])->name('user.page.index');
    Route::get('/questions/{question}/answer', [QuestionController::class, 'showAnswerForm'])->name('user.page.answer');
    Route::post('/questions/{question}/submit', [QuestionController::class, 'submitAnswer'])->name('user.page.submit');
});

// Admin Routes
Route::prefix('admin/page')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.page.dashboard');

    Route::get('/market/create', [ProductController::class, 'create'])->name('admin.page.items.create');
    Route::post('/market', [ProductController::class, 'store'])->name('admin.page.items.store'); // Changed to POST
    Route::get('/market/{product}/edit', [ProductController::class, 'edit'])->name('admin.page.items.edit'); // Changed to include product
    Route::put('/market/{product}', [ProductController::class, 'update'])->name('admin.page.items.update'); // Changed to PUT
    Route::delete('/market/{product}', [ProductController::class, 'destroy'])->name('admin.page.items.destroy'); // Changed to DELETE
    Route::get('/market', [ProductController::class, 'index'])->name('admin.page.market');
    // Transaction routes
    Route::get('/admin/transactions', [TransactionController::class, 'adminIndex'])->name('admin.page.transactions');
    Route::put('/admin/transaction/{id}/update', [TransactionController::class, 'updateStatus'])->name('admin.transaction.update');
    //Quest
    Route::resource('questions', QuestionController::class)->except(['show']);
    Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::put('/{question}/verify', [QuestionController::class, 'verifyAnswer'])->name('questions.verify');
});

// Login and Registration routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
