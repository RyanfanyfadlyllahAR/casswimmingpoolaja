<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PesertaController;

// Halaman Beranda
Route::get('/', function () {
    return view('branda', ['title' => 'Branda']);
});

// Halaman Tentang
Route::get('/tentang', function () {
    return view('tentang', ['title' => 'Tentang']);
});

// Halaman Fasilitas
Route::get('/fasilitas', function () {
    return view('fasilitas', ['title' => 'Fasilitas']);
});


Route::get('/kontak', function () {
    return view('kontak', ['title' => 'Kontak']);
});

// Halaman Galeri
Route::get('/galeri', function () {
    return view('galeri', ['title' => 'Galeri']);
});


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login']);
    Route::get('/daftar', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('peserta', PesertaController::class);
    });
});






