<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruktur;

class InstrukturController extends Controller
{
    // Admin: Kelola instruktur (index)
    public function index(Request $request)
    {
        $title = 'Kelola Instruktur';
        $query = Instruktur::with('Jadwal_Kursus')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_instruktur', 'like', "%{$search}%")
                ->orWhere('keahlian', 'like', "%{$search}%")
                ->orWhere('no_telp', 'like', "%{$search}%");
        }

        $instrukturs = $query->get();
        return view('admin.instruktur.index', compact('instrukturs', 'title'));
    }

    // Admin: Form tambah instruktur
    public function create()
    {
        $title = 'Tambah Instruktur';
        return view('admin.instruktur.create', compact('title'));
    }

    // Admin: Simpan instruktur baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_instruktur' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telp' => 'required|string|max:15',
            'keahlian' => 'required|string',
            'sertifikat' => 'nullable|string|max:255',
            'pengalaman' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            Instruktur::create($validated);
            return redirect()->route('admin.instruktur')->with('success', 'Instruktur berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan instruktur.');
        }
    }

    // Admin: Detail instruktur
    public function show(Instruktur $instruktur)
    {
        $title = 'Detail Instruktur - ' . $instruktur->nama_instruktur;
        $jadwals = $instruktur->Jadwal_Kursus()->with('kursus')->latest()->get();
        
        return view('admin.instruktur.show', compact('instruktur', 'jadwals', 'title'));
    }

    // Admin: Form edit instruktur
    public function edit(Instruktur $instruktur)
    {
        $title = 'Edit Instruktur - ' . $instruktur->nama_instruktur;
        return view('admin.instruktur.edit', compact('instruktur', 'title'));
    }

    // Admin: Update instruktur
    public function update(Request $request, Instruktur $instruktur)
    {
        $validated = $request->validate([
            'nama_instruktur' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_telp' => 'required|string|max:15',
            'keahlian' => 'required|string',
            'sertifikat' => 'nullable|string|max:255',
            'pengalaman' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $instruktur->update($validated);
            return redirect()->route('admin.instruktur')->with('success', 'Instruktur berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui instruktur.');
        }
    }

    // Admin: Hapus instruktur
    public function destroy(Instruktur $instruktur)
    {
        try {
            // Cek apakah instruktur masih memiliki jadwal aktif
            $jadwalAktif = $instruktur->Jadwal_Kursus()->where('status', 'aktif')->count();
            
            if ($jadwalAktif > 0) {
                return back()->with('error', 'Tidak dapat menghapus instruktur yang masih memiliki jadwal aktif.');
            }

            $instruktur->delete();
            return redirect()->route('admin.instruktur')->with('success', 'Instruktur berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus instruktur.');
        }
    }
}
