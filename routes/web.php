<?php

use App\Models\Informasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PendaftarController;




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

// Halaman Informasi (semua data)
Route::get('/informasis', [InformasiController::class, 'index']);

// Halaman Detail Informasi
Route::get('/informasis/{slug}', [InformasiController::class, 'show']);
// Halaman Kontak
Route::get('/kontak', function () {
    return view('kontak', ['title' => 'Kontak']);
});

// Halaman Galeri
Route::get('/galeri', function () {
    return view('galeri', ['title' => 'Galeri']);
});

Route::resource('pendaftar', PendaftarController::class);





