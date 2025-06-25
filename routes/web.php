<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KursusController;

// Halaman Beranda
Route::get('/', function () {
    return view('branda', ['title' => 'Branda']);
});

// Halaman statis
Route::get('/tentang', function () {
    return view('tentang', ['title' => 'Tentang']);
});

Route::get('/fasilitas', function () {
    return view('fasilitas', ['title' => 'Fasilitas']);
});

Route::get('/kontak', function () {
    return view('kontak', ['title' => 'Kontak']);
});

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

// Kursus Routes (untuk semua user)
Route::get('/kursus', [KursusController::class, 'index'])->name('kursus.index');
Route::get('/kursus/{kursus}', [KursusController::class, 'show'])->name('kursus.show');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // Kursus Routes untuk user yang login
    Route::post('/kursus/{kursus}/daftar', [KursusController::class, 'daftar'])->name('kursus.daftar');
    Route::get('/kursus-ku', [KursusController::class, 'kursusKu'])->name('kursus.ku');
    
    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('peserta', PesertaController::class);
        
        // Admin Kursus Routes
        Route::get('/admin/kursus', [KursusController::class, 'admin'])->name('admin.kursus');
        Route::get('/admin/kursus/create', [KursusController::class, 'create'])->name('admin.kursus.create');
        Route::post('/admin/kursus', [KursusController::class, 'store'])->name('admin.kursus.store');
        Route::get('/admin/kursus/{kursus}', [KursusController::class, 'adminShow'])->name('admin.kursus.show');
        Route::get('/admin/kursus/{kursus}/edit', [KursusController::class, 'edit'])->name('admin.kursus.edit');
        Route::put('/admin/kursus/{kursus}', [KursusController::class, 'update'])->name('admin.kursus.update');
        Route::delete('/admin/kursus/{kursus}', [KursusController::class, 'destroy'])->name('admin.kursus.destroy');
    });
});






