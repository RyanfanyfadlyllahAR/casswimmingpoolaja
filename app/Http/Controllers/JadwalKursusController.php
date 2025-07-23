<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal_Kursus;
use App\Models\Kursus;
use App\Models\Instruktur;

class JadwalKursusController extends Controller
{
    // Admin: Kelola jadwal kursus (index)
    public function index()
    {
        $title = 'Kelola Jadwal Kursus';
        $jadwals = Jadwal_Kursus::with(['kursus', 'instruktur'])->latest()->get();
        
        return view('admin.jadwal.index', compact('jadwals', 'title'));
    }

    // Admin: Form tambah jadwal
    public function create()
    {
        $title = 'Tambah Jadwal Kursus';
        $kursus = Kursus::aktif()->get();
        $instrukturs = Instruktur::aktif()->get();
        
        return view('admin.jadwal.create', compact('title', 'kursus', 'instrukturs'));
    }

    // Admin: Simpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'instruktur_id' => 'required|exists:instrukturs,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kapasitas_maksimal' => 'required|integer|min:1|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            // Cek konflik jadwal instruktur
            $konflik = Jadwal_Kursus::where('instruktur_id', $validated['instruktur_id'])
                                ->where('hari', $validated['hari'])
                                ->where('status', 'aktif')
                                ->where(function ($query) use ($validated) {
                                    $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                                            ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                                            ->orWhere(function ($q) use ($validated) {
                                                $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                                                ->where('jam_selesai', '>=', $validated['jam_selesai']);
                                            });
                                })->exists();

            if ($konflik) {
                return back()->with('error', 'Instruktur sudah memiliki jadwal pada hari dan jam tersebut.');
            }

            Jadwal_Kursus::create($validated);
            return redirect()->route('admin.jadwal')->with('success', 'Jadwal kursus berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan jadwal: ' . $e->getMessage());
        }
    }

    // Admin: Detail jadwal
    public function show(Jadwal_Kursus $jadwal)
    {
        $title = 'Detail Jadwal Kursus';
        $pesertas = $jadwal->pesertas()->with('user')->latest()->get();
        
        return view('admin.jadwal.show', compact('jadwal', 'pesertas', 'title'));
    }

    // Admin: Form edit jadwal
    public function edit(Jadwal_Kursus $jadwal)
    {
        $title = 'Edit Jadwal Kursus';
        $kursus = Kursus::aktif()->get();
        $instrukturs = Instruktur::aktif()->get();
        
        return view('admin.jadwal.edit', compact('jadwal', 'title', 'kursus', 'instrukturs'));
    }

    // Admin: Update jadwal
    public function update(Request $request, Jadwal_Kursus $jadwal)
    {
        $validated = $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'instruktur_id' => 'required|exists:instrukturs,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kapasitas_maksimal' => 'required|integer|min:1|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        try {
            // Cek konflik jadwal instruktur (kecuali jadwal yang sedang di-edit)
            $konflik = Jadwal_Kursus::where('instruktur_id', $validated['instruktur_id'])
                                  ->where('hari', $validated['hari'])
                                  ->where('status', 'aktif')
                                  ->where('id', '!=', $jadwal->id)
                                  ->where(function ($query) use ($validated) {
                                      $query->whereBetween('jam_mulai', [$validated['jam_mulai'], $validated['jam_selesai']])
                                            ->orWhereBetween('jam_selesai', [$validated['jam_mulai'], $validated['jam_selesai']])
                                            ->orWhere(function ($q) use ($validated) {
                                                $q->where('jam_mulai', '<=', $validated['jam_mulai'])
                                                  ->where('jam_selesai', '>=', $validated['jam_selesai']);
                                            });
                                  })->exists();

            if ($konflik) {
                return back()->with('error', 'Instruktur sudah memiliki jadwal pada hari dan jam tersebut.');
            }

            $jadwal->update($validated);
            return redirect()->route('admin.jadwal')->with('success', 'Jadwal kursus berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui jadwal.');
        }
    }

    // Admin: Hapus jadwal
    public function destroy(Jadwal_Kursus $jadwal)
    {
        try {
            // Cek apakah masih ada peserta aktif
            $pesertaAktif = $jadwal->pesertas()->where('status', 'aktif')->count();
            
            if ($pesertaAktif > 0) {
                return back()->with('error', 'Tidak dapat menghapus jadwal yang masih memiliki peserta aktif.');
            }

            $jadwal->delete();
            return redirect()->route('admin.jadwal')->with('success', 'Jadwal kursus berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus jadwal.');
        }
    }
}
