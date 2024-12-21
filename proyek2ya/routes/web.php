<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('user.page.dashboard');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\Controller::class, 'dashboard'])->name('dashboard');
Route::get('/market', [App\Http\Controllers\Controller::class, 'market'])->name('market');
Route::get('/academic', [App\Http\Controllers\Controller::class, 'academic'])->name('academic');
Route::get('/quiz', [App\Http\Controllers\Controller::class, 'quiz'])->name('quiz');
