<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\JadwalKursusController;
use App\Http\Controllers\TransaksiController;

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
    
    // Route untuk transaksi - PERBAIKAN
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/create-payment', [TransaksiController::class, 'createPayment'])->name('transaksi.create.payment');
    Route::get('/transaksi/finish', [TransaksiController::class, 'finish'])->name('transaksi.finish');
    Route::get('/transaksi/unfinish', [TransaksiController::class, 'unfinish'])->name('transaksi.unfinish');
    Route::get('/transaksi/error', [TransaksiController::class, 'error'])->name('transaksi.error');
    Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{transaksi}/check-status', [TransaksiController::class, 'checkStatus'])->name('transaksi.check-status');
    
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
        
        // Admin Instruktur Routes
        Route::get('/admin/instruktur', [InstrukturController::class, 'index'])->name('admin.instruktur');
        Route::get('/admin/instruktur/create', [InstrukturController::class, 'create'])->name('admin.instruktur.create');
        Route::post('/admin/instruktur', [InstrukturController::class, 'store'])->name('admin.instruktur.store');
        Route::get('/admin/instruktur/{instruktur}', [InstrukturController::class, 'show'])->name('admin.instruktur.show');
        Route::get('/admin/instruktur/{instruktur}/edit', [InstrukturController::class, 'edit'])->name('admin.instruktur.edit');
        Route::put('/admin/instruktur/{instruktur}', [InstrukturController::class, 'update'])->name('admin.instruktur.update');
        Route::delete('/admin/instruktur/{instruktur}', [InstrukturController::class, 'destroy'])->name('admin.instruktur.destroy');
        
        // Admin Jadwal Routes
        Route::get('/admin/jadwal', [JadwalKursusController::class, 'index'])->name('admin.jadwal');
        Route::get('/admin/jadwal/create', [JadwalKursusController::class, 'create'])->name('admin.jadwal.create');
        Route::post('/admin/jadwal', [JadwalKursusController::class, 'store'])->name('admin.jadwal.store');
        Route::get('/admin/jadwal/{jadwal}', [JadwalKursusController::class, 'show'])->name('admin.jadwal.show');
        Route::get('/admin/jadwal/{jadwal}/edit', [JadwalKursusController::class, 'edit'])->name('admin.jadwal.edit');
        Route::put('/admin/jadwal/{jadwal}', [JadwalKursusController::class, 'update'])->name('admin.jadwal.update');
        Route::delete('/admin/jadwal/{jadwal}', [JadwalKursusController::class, 'destroy'])->name('admin.jadwal.destroy');
        
        // Route admin transaksi
        Route::get('/admin/transaksi', [TransaksiController::class, 'adminIndex'])->name('admin.transaksi.index');
        Route::get('/admin/transaksi/{transaksi}', [TransaksiController::class, 'adminShow'])->name('admin.transaksi.show');
        Route::put('/admin/transaksi/{transaksi}/update-status', [TransaksiController::class, 'adminUpdateStatus'])->name('admin.transaksi.update-status');
        Route::post('/admin/transaksi/{transaksi}/sync-status', [TransaksiController::class, 'adminSyncStatus'])->name('admin.transaksi.sync-status');
    });
});

// Callback dari Midtrans (tidak perlu auth)
Route::post('/transaksi/callback', [TransaksiController::class, 'callback'])->name('transaksi.callback');






