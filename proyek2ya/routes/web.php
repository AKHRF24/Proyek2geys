<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman Admin
Route::get('/dashboard', function () {
    return view('admin.page.dashboard');
});

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/user/dashboard', [App\Http\Controllers\Controller::class, 'dashboard'])->name('dashboard');
Route::get('/market', [App\Http\Controllers\Controller::class, 'market'])->name('market');
// Route::get('/quiz', [App\Http\Controllers\Controller::class, 'quiz'])->name('quiz');

// Admin Routes (Prefix: admin/page)
Route::prefix('admin/page')->group(function () {
    Route::get('dashboard', [Controller::class, 'index'])->name('admin.page.dashboard');
    Route::get('market', [ProductController::class, 'index'])->name('admin.page.market');
    Route::get('product/create', [ProductController::class, 'create'])->name('admin.page.product.create');
    Route::post('market', [ProductController::class, 'store'])->name('admin.page.product.store');
    Route::get('product/{product}/edit', [ProductController::class, 'edit'])->name('admin.page.product.edit');
    Route::put('product/{product}', [ProductController::class, 'update'])->name('admin.page.product.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('admin.page.product.destroy');
});
