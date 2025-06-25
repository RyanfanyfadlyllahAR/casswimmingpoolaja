<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\PesertaController;
use Illuminate\Auth\Events\Login;

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



Route::get('/masuk', [LoginController::class, 'index']);

Route::get('/daftar', [DaftarController::class, 'index']);

Route::resource('peserta', PesertaController::class);






