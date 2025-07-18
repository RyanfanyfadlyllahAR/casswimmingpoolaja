<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use App\Models\Kursus;
use App\Models\Jadwal_Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaController extends Controller
{
    // Tampilkan daftar peserta untuk admin
    public function index(Request $request)
    {
        $title = 'Kelola Peserta';
        $query = Peserta::with(['user', 'kursus', 'jadwal.instruktur'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('kursus', function($q) use ($search) {
                $q->where('nama_kursus', 'like', "%{$search}%");
            });
        }

        $pesertas = $query->get();
        return view('peserta.index', compact('pesertas', 'title'));
    }

    // Form tambah peserta manual oleh admin
    public function create()
    {
        $title = 'Tambah Peserta';
        $users = User::where('is_admin', 0)->orderBy('nama_lengkap')->get();
        $kursus = Kursus::where('status', 'aktif')->orderBy('nama_kursus')->get();
        $jadwals = Jadwal_Kursus::with(['kursus', 'instruktur'])
                                ->where('status', 'aktif')
                                ->orderBy('hari')
                                ->get();

        return view('peserta.create', compact('title', 'users', 'kursus', 'jadwals'));
    }

    // Simpan peserta baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kursus_id' => 'required|exists:kursus,id',
            'jadwal_id' => 'required|exists:jadwal_kursus,id',
            'status' => 'required|in:aktif,nonaktif,selesai,batal',
            'status_pembayaran' => 'required|in:lunas,pending,failed',
            'tanggal_daftar' => 'required|date'
        ]);

        try {
            // Cek apakah user sudah terdaftar di kursus yang sama
            $existingPeserta = Peserta::where('user_id', $request->user_id)
                                    ->where('kursus_id', $request->kursus_id)
                                    ->first();

            if ($existingPeserta) {
                return back()->with('error', 'User sudah terdaftar di kursus ini.');
            }

            // Cek kapasitas jadwal
            $jadwal = Jadwal_Kursus::find($request->jadwal_id);
            if ($jadwal->kapasitasTersedia() <= 0) {
                return back()->with('error', 'Jadwal sudah penuh.');
            }

            Peserta::create($request->all());
            return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan peserta.');
        }
    }

    // Tampilkan detail peserta
    public function show(Peserta $peserta)
    {
        $peserta->load(['user', 'kursus', 'jadwal.instruktur', 'transaksi']);

        if(!$peserta->user) {
            return redirect()->route('peserta.index')->with('error', 'Peserta tidak ditemukan.');
        }

        $title = 'Detail Peserta - ' . $peserta->user->nama_lengkap;
        $peserta->load(['user', 'kursus', 'jadwal.instruktur', 'transaksi']);

        return view('peserta.show', compact('peserta', 'title'));
    }

    // Form edit peserta
    public function edit(Peserta $peserta)
    {
        $title = 'Edit Peserta - ' . $peserta->user->nama_lengkap;
        $users = User::where('is_admin', 0)->orderBy('nama_lengkap')->get();
        $kursus = Kursus::orderBy('nama_kursus')->get();
        $jadwals = Jadwal_Kursus::with(['kursus', 'instruktur'])
                                ->orderBy('hari')
                                ->get();

        return view('peserta.edit', compact('peserta', 'title', 'users', 'kursus', 'jadwals'));
    }

    // Update data peserta
    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kursus_id' => 'required|exists:kursus,id',
            'jadwal_id' => 'required|exists:jadwal_kursus,id',
            'status' => 'required|in:aktif,nonaktif',
            'status_pembayaran' => 'required|in:lunas,pending,batal',
            'tanggal_daftar' => 'required|date'
        ]);

        try {
            // Cek apakah user sudah terdaftar di kursus yang sama (kecuali dirinya sendiri)
            $existingPeserta = Peserta::where('user_id', $request->user_id)
                                    ->where('kursus_id', $request->kursus_id)
                                    ->where('id', '!=', $peserta->id)
                                    ->first();

            if ($existingPeserta) {
                return back()->with('error', 'User sudah terdaftar di kursus ini.');
            }

            $peserta->update($request->all());
            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage() ?: 'Terjadi kesalahan saat memperbarui data peserta.');
        }
    }

    // Hapus peserta
    public function destroy(Peserta $peserta)
    {
        try {
            $nama = $peserta->user->nama_lengkap;

            // Cek apakah ada transaksi terkait
            if ($peserta->transaksi && $peserta->transaksi->status_pembayaran === 'settlement') {
                return back()->with('error', 'Tidak dapat menghapus peserta yang sudah melakukan pembayaran.');
            }

            $peserta->delete();
            return redirect()->route('peserta.index')->with('success', "Peserta {$nama} berhasil dihapus!");

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus peserta.');
        }
    }

    // API untuk mendapatkan jadwal berdasarkan kursus (AJAX)
    public function getJadwalByKursus(Request $request)
    {
        $jadwals = Jadwal_Kursus::with('instruktur')
                               ->where('kursus_id', $request->kursus_id)
                               ->where('status', 'aktif')
                               ->get();

        return response()->json($jadwals);
    }
}
