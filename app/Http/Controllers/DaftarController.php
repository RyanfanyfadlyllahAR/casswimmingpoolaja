<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarController extends Controller
{
public function index()
{
    return view('daftar.index', ['title' => 'Halaman Daftar']);
    }
}
