<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MarketPointController;
use App\Http\Controllers\ItemsController;
use App\Http\Models\Items;
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

Route::get('/admina', function () {
    return view('admin/page/product');
});
Route::get('/adminb', function () {
    return view('admin.page.bayar');
});

Route::get('/items/create', function () {
    return view('admin.page.items.create');
});

// Route::get('/dashboard', function () {
//     return view('user.page.dashboard');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user/dashboard', [App\Http\Controllers\Controller::class, 'dashboard'])->name('dashboard');
Route::get('/market', [App\Http\Controllers\Controller::class, 'market'])->name('market');
Route::get('/quiz', [App\Http\Controllers\Controller::class, 'quiz'])->name('quiz');


// Rute untuk halaman Items
Route::get('/items', [ItemsController::class, 'index'])->name('items.index'); // Menampilkan daftar items
Route::get('/items/create', [ItemsController::class, 'create'])->name('items.create'); // Form tambah item
Route::post('/items', [ItemsController::class, 'store'])->name('items.store'); // Menyimpan item baru
Route::get('/items/{id}', [ItemsController::class, 'show'])->name('items.show'); // Menampilkan detail item
Route::get('/items/{id}/edit', [ItemsController::class, 'edit'])->name('items.edit'); // Form edit item
Route::put('/items/{id}', [ItemsController::class, 'update'])->name('items.update'); // Mengupdate item
Route::delete('/items/{id}', [ItemsController::class, 'destroy'])->name('items.destroy'); // Menghapus item

