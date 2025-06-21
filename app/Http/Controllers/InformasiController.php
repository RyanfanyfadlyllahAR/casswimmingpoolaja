<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;


class InformasiController extends Controller
{
    public function index()
    {
        return view('informasis', [
            'title' => 'Informasi',
            'informasis' => Informasi::all()
        ]);
    }

    public function show($slug)
    {
        $informasi = Informasi::find($slug);

        if (!$informasi) {
            abort(404);
        }

        return view('informasi', [
            'title' => 'Informasi',
            'informasi' => $informasi
        ]);
    }
}

