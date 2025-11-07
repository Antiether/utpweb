<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Semua user login bisa melihat daftar barang
Route::middleware(['auth'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('barang', BarangController::class)->except(['index']);
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'update', 'destroy']);
});

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'formPengembalian'])->name('peminjaman.formPengembalian');
    Route::put('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'prosesPengembalian'])->name('peminjaman.prosesPengembalian');
});
