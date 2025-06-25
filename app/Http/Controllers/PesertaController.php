<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::all();
        $title = 'Daftar Peserta';
        return view('peserta.index', compact('pesertas', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Peserta';
        return view('peserta.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);
        Peserta::create($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan!');
    }

    public function edit(Peserta $peserta)
    {
        $title = 'Edit Peserta';
        return view('peserta.edit', compact('peserta', 'title'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pesertas,email,'.$peserta->id,
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);
        $peserta->update($request->all());
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diupdate!');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus!');
    }
}