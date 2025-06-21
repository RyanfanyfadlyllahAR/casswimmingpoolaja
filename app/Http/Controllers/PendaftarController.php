<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;


class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Halaman Pendaftaran';
        $pendaftars = Pendaftar::all();
        

        return view('pendaftar.index', compact('title', 'pendaftars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pendaftar';
        return view('pendaftar.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'paket_dipilih' => 'required',
            'status_pendaftaran' => 'required'
        ]);

        Pendaftar::create($validated);
        
        return redirect()->route('pendaftar.index')
            ->with('success', 'Pendaftar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftar $pendaftar)
    {
        $title = 'Detail Pendaftar';
        return view('pendaftar.show', compact('pendaftar', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftar $pendaftar)
    {
        $title = 'Edit Pendaftar';
        return view('pendaftar.edit', compact('title', 'pendaftar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'paket_dipilih' => 'required',
            'status_pendaftaran' => 'required'
        ]);

        $pendaftar->update($validated);

        return redirect()->route('pendaftar.index')
            ->with('success', 'Pendaftar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftar $pendaftar)
    {
        $pendaftar->delete();
        
        return redirect()->route('pendaftar.index')
            ->with('success', 'Pendaftar berhasil dihapus!');
    }
}