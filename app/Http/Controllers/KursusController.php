<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Peserta;
use App\Models\Jadwal_Kursus;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    // Tampilkan daftar kursus untuk user
    public function index()
    {
        try {
            $kursus = Kursus::aktif()->with('Jadwal_Kursus.instruktur')->get();
            $title = 'Daftar Kursus';
            
            return view('kursus.index', compact('kursus', 'title'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat data kursus.');
        }
    }

    // Tampilkan detail kursus dengan jadwal
    public function show(Kursus $kursus)
    {
        $title = 'Detail Kursus - ' . $kursus->nama_kursus;
        $sudahDaftar = false;
        $jadwals = $kursus->Jadwal_Kursus()->aktif()->with('instruktur')->get();
        
        if (Auth::check()) {
            $sudahDaftar = Peserta::where('user_id', Auth::id())
                                 ->where('kursus_id', $kursus->id)
                                 ->exists();
        }
        
        return view('kursus.show', compact('kursus', 'title', 'sudahDaftar', 'jadwals'));
    }

    // Proses pendaftaran kursus dengan jadwal
    public function daftar(Request $request, Kursus $kursus)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_kursus,id'
        ]);

        try {
            // Cek apakah user sudah mendaftar kursus ini
            $sudahDaftar = Peserta::where('user_id', Auth::id())
                                 ->where('kursus_id', $kursus->id)
                                 ->exists();

            if ($sudahDaftar) {
                return back()->with('error', 'Anda sudah mendaftar di kursus ini.');
            }

            // Cek apakah kursus masih aktif
            if ($kursus->status !== 'aktif') {
                return back()->with('error', 'Kursus ini tidak tersedia untuk pendaftaran.');
            }

            // Cek kapasitas jadwal
            $jadwal = Jadwal_Kursus::find($request->jadwal_id);
            if ($jadwal->kapasitasTersedia() <= 0) {
                return back()->with('error', 'Jadwal ini sudah penuh.');
            }

            // Daftarkan user ke kursus dengan jadwal
            Peserta::create([
                'user_id' => Auth::id(),
                'kursus_id' => $kursus->id,
                'jadwal_id' => $request->jadwal_id,
                'status' => 'aktif',
                'tanggal_daftar' => now()->format('Y-m-d'),
            ]);

            return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar kursus ' . $kursus->nama_kursus . '!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mendaftar kursus.');
        }
    }

    // Tampilkan kursus yang diikuti user
    public function kursusKu()
    {
        $title = 'Kursus Saya';
        $pesertas = Peserta::with(['kursus', 'jadwal.instruktur'])
                          ->where('user_id', Auth::id())
                          ->latest()
                          ->get();
        
        return view('kursus.kursus-ku', compact('pesertas', 'title'));
    }

    // ========== ADMIN CRUD METHODS ==========

    // Admin: Kelola kursus (index)
    public function admin()
    {
        $title = 'Kelola Kursus';
        $kursus = Kursus::withCount(['pesertas', 'Jadwal_Kursus'])->latest()->get();
        
        return view('admin.kursus.index', compact('kursus', 'title'));
    }

    // Admin: Form tambah kursus
    public function create()
    {
        $title = 'Tambah Kursus';
        return view('admin.kursus.create', compact('title'));
    }

    // Admin: Simpan kursus baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string|max:100',
            'biaya' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            Kursus::create($validated);
            return redirect()->route('admin.kursus')->with('success', 'Kursus berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan kursus.');
        }
    }

    // Admin: Detail kursus untuk admin
    public function adminShow(Kursus $kursus)
    {
        $title = 'Detail Kursus - ' . $kursus->nama_kursus;
        $pesertas = $kursus->pesertas()->with(['user', 'jadwal.instruktur'])->latest()->get();
        $jadwals = $kursus->Jadwal_Kursus()->with('instruktur')->get();
        
        return view('admin.kursus.show', compact('kursus', 'pesertas', 'jadwals', 'title'));
    }

    // Admin: Form edit kursus
    public function edit(Kursus $kursus)
    {
        $title = 'Edit Kursus - ' . $kursus->nama_kursus;
        return view('admin.kursus.edit', compact('kursus', 'title'));
    }

    // Admin: Update kursus
    public function update(Request $request, Kursus $kursus)
    {
        $validated = $request->validate([
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string|max:100',
            'biaya' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            $kursus->update($validated);
            return redirect()->route('admin.kursus')->with('success', 'Kursus berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui kursus.');
        }
    }

    // Admin: Hapus kursus
    public function destroy(Kursus $kursus)
    {
        try {
            // Cek apakah masih ada peserta aktif
            $pesertaAktif = $kursus->pesertas()->where('status', 'aktif')->count();
            
            if ($pesertaAktif > 0) {
                return back()->with('error', 'Tidak dapat menghapus kursus yang masih memiliki peserta aktif.');
            }

            $kursus->delete();
            return redirect()->route('admin.kursus')->with('success', 'Kursus berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus kursus.');
        }
    }
}
