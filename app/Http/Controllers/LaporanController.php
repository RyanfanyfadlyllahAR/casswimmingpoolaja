<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peserta;
use App\Models\Kursus;
use App\Models\Instruktur;
use App\Models\Jadwal_Kursus;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    

    // Halaman laporan
    public function index()
    {
        $title = 'Laporan Sistem';
        
        // Data statistik untuk preview
        $stats = [
            'total_users' => User::where('is_admin', 0)->count(),
            'total_peserta' => Peserta::count(),
            'total_kursus' => Kursus::count(),
            'total_instruktur' => Instruktur::count(),
            'total_jadwal' => Jadwal_Kursus::count(),
            'total_transaksi' => Transaksi::count(),
            'total_pendapatan' => Transaksi::whereIn('status_pembayaran', ['success', 'capture'])->sum('jumlah'),
            'transaksi_pending' => Transaksi::where('status_pembayaran', 'pending')->count(),
            'peserta_aktif' => Peserta::where('status', 'aktif')->count(),
            'peserta_selesai' => Peserta::where('status', 'selesai')->count(),
        ];

        return view('admin.laporan.index', compact('title', 'stats'));
    }

    // Generate laporan lengkap
    public function generateLaporan(Request $request)
    {
        $request->validate([
            'jenis_laporan' => 'required|in:lengkap,peserta,transaksi,kursus,instruktur',
            'periode' => 'nullable|in:hari_ini,minggu_ini,bulan_ini,tahun_ini,custom',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $jenisLaporan = $request->jenis_laporan;
        $periode = $request->periode;
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        // Set periode default jika tidak ada
        if (!$periode || $periode === 'custom') {
            if (!$tanggalMulai || !$tanggalSelesai) {
                $tanggalMulai = now()->startOfMonth()->format('Y-m-d');
                $tanggalSelesai = now()->endOfMonth()->format('Y-m-d');
            }
        } else {
            switch ($periode) {
                case 'hari_ini':
                    $tanggalMulai = now()->format('Y-m-d');
                    $tanggalSelesai = now()->format('Y-m-d');
                    break;
                case 'minggu_ini':
                    $tanggalMulai = now()->startOfWeek()->format('Y-m-d');
                    $tanggalSelesai = now()->endOfWeek()->format('Y-m-d');
                    break;
                case 'bulan_ini':
                    $tanggalMulai = now()->startOfMonth()->format('Y-m-d');
                    $tanggalSelesai = now()->endOfMonth()->format('Y-m-d');
                    break;
                case 'tahun_ini':
                    $tanggalMulai = now()->startOfYear()->format('Y-m-d');
                    $tanggalSelesai = now()->endOfYear()->format('Y-m-d');
                    break;
            }
        }

        // Generate data berdasarkan jenis laporan
        $data = $this->getDataLaporan($jenisLaporan, $tanggalMulai, $tanggalSelesai);
        
        $filename = $this->generateFilename($jenisLaporan, $periode);

        // Generate PDF
        $pdf = PDF::loadView('admin.laporan.pdf', compact(
            'data', 
            'jenisLaporan', 
            'periode', 
            'tanggalMulai', 
            'tanggalSelesai'
        ));

        return $pdf->download($filename);
    }

    // Get data berdasarkan jenis laporan
    private function getDataLaporan($jenisLaporan, $tanggalMulai, $tanggalSelesai)
    {
        $data = [];

        switch ($jenisLaporan) {
            case 'lengkap':
                $data = $this->getLaporanLengkap($tanggalMulai, $tanggalSelesai);
                break;
            case 'peserta':
                $data = $this->getLaporanPeserta($tanggalMulai, $tanggalSelesai);
                break;
            case 'transaksi':
                $data = $this->getLaporanTransaksi($tanggalMulai, $tanggalSelesai);
                break;
            case 'kursus':
                $data = $this->getLaporanKursus($tanggalMulai, $tanggalSelesai);
                break;
            case 'instruktur':
                $data = $this->getLaporanInstruktur($tanggalMulai, $tanggalSelesai);
                break;
        }

        return $data;
    }

    // Laporan lengkap semua data
    private function getLaporanLengkap($tanggalMulai, $tanggalSelesai)
    {
        return [
            'statistik' => [
                'total_users' => User::where('is_admin', 0)->count(),
                'total_peserta' => Peserta::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
                'total_kursus' => Kursus::count(),
                'total_instruktur' => Instruktur::count(),
                'total_transaksi' => Transaksi::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
                'total_pendapatan' => Transaksi::whereIn('status_pembayaran', ['success', 'capture'])
                                              ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                                              ->sum('jumlah'),
                'peserta_aktif' => Peserta::where('status', 'aktif')->count(),
                'peserta_selesai' => Peserta::where('status', 'selesai')->count(),
            ],
            'users' => User::where('is_admin', 0)->orderBy('created_at', 'desc')->get(),
            'peserta' => Peserta::with(['user', 'kursus', 'jadwal.instruktur'])
                               ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                               ->orderBy('created_at', 'desc')
                               ->get(),
            'kursus' => Kursus::withCount('pesertas')->orderBy('created_at', 'desc')->get(),
            'instruktur' => Instruktur::withCount('jadwal_kursus')->orderBy('created_at', 'desc')->get(),
            'transaksi' => Transaksi::with(['user', 'kursus'])
                                   ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                                   ->orderBy('created_at', 'desc')
                                   ->get(),
        ];
    }

    // Laporan peserta
    private function getLaporanPeserta($tanggalMulai, $tanggalSelesai)
    {
        return [
            'peserta' => Peserta::with(['user', 'kursus', 'jadwal.instruktur'])
                               ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                               ->orderBy('created_at', 'desc')
                               ->get(),
            'statistik' => [
                'total_peserta' => Peserta::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
                'peserta_aktif' => Peserta::where('status', 'aktif')->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
                'peserta_selesai' => Peserta::where('status', 'selesai')->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
                'peserta_batal' => Peserta::where('status', 'batal')->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])->count(),
            ]
        ];
    }

    // Laporan transaksi
    private function getLaporanTransaksi($tanggalMulai, $tanggalSelesai)
    {
        $transaksi = Transaksi::with(['user', 'kursus'])
                             ->whereBetween('created_at', [$tanggalMulai, $tanggalSelesai . ' 23:59:59'])
                             ->orderBy('created_at', 'desc')
                             ->get();

        return [
            'transaksi' => $transaksi,
            'statistik' => [
                'total_transaksi' => $transaksi->count(),
                'total_pendapatan' => $transaksi->whereIn('status_pembayaran', ['success', 'capture'])->sum('jumlah'),
                'transaksi_lunas' => $transaksi->whereIn('status_pembayaran', ['success', 'capture'])->count(),
                'transaksi_pending' => $transaksi->where('status_pembayaran', 'pending')->count(),
                'transaksi_gagal' => $transaksi->whereIn('status_pembayaran', ['failed', 'cancel', 'expire'])->count(),
            ]
        ];
    }

    // Laporan kursus
    private function getLaporanKursus($tanggalMulai, $tanggalSelesai)
    {
        return [
            'kursus' => Kursus::withCount([
                            'pesertas',
                            'pesertas as pesertas_aktif_count' => function($query) {
                                $query->where('status', 'aktif');
                            },
                            'pesertas as pesertas_selesai_count' => function($query) {
                                $query->where('status', 'selesai');
                            }
                        ])
                        ->orderBy('created_at', 'desc')
                        ->get(),
            'statistik' => [
                'total_kursus' => Kursus::count(),
                'kursus_aktif' => Kursus::where('status', 'aktif')->count(),
                'kursus_nonaktif' => Kursus::where('status', 'nonaktif')->count(),
            ]
        ];
    }

    // Laporan instruktur
    private function getLaporanInstruktur($tanggalMulai, $tanggalSelesai)
    {
        return [
            'instruktur' => Instruktur::withCount('jadwals')
                                    ->with(['jadwals.pesertas'])
                                    ->orderBy('created_at', 'desc')
                                    ->get(),
            'statistik' => [
                'total_instruktur' => Instruktur::count(),
                'instruktur_aktif' => Instruktur::where('status', 'aktif')->count(),
            ]
        ];
    }

    // Generate filename
    private function generateFilename($jenisLaporan, $periode)
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $jenis = ucfirst($jenisLaporan);
        
        return "Laporan_{$jenis}_{$periode}_{$timestamp}.pdf";
    }

    // Preview laporan
    public function preview(Request $request)
    {
        $jenisLaporan = $request->get('jenis_laporan', 'lengkap');
        $periode = $request->get('periode', 'bulan_ini');
        
        $tanggalMulai = now()->startOfMonth()->format('Y-m-d');
        $tanggalSelesai = now()->endOfMonth()->format('Y-m-d');
        // Set periode default jika tidak ada
    if (!$periode || $periode === 'custom') {
        if (!$tanggalMulai || !$tanggalSelesai) {
            $tanggalMulai = now()->startOfMonth()->format('Y-m-d');
            $tanggalSelesai = now()->endOfMonth()->format('Y-m-d');
        }
    } else {
        switch ($periode) {
            case 'hari_ini':
                $tanggalMulai = now()->format('Y-m-d');
                $tanggalSelesai = now()->format('Y-m-d');
                break;
            case 'minggu_ini':
                $tanggalMulai = now()->startOfWeek()->format('Y-m-d');
                $tanggalSelesai = now()->endOfWeek()->format('Y-m-d');
                break;
            case 'bulan_ini':
                $tanggalMulai = now()->startOfMonth()->format('Y-m-d');
                $tanggalSelesai = now()->endOfMonth()->format('Y-m-d');
                break;
            case 'tahun_ini':
                $tanggalMulai = now()->startOfYear()->format('Y-m-d');
                $tanggalSelesai = now()->endOfYear()->format('Y-m-d');
                break;
        }
    }
        $data = $this->getDataLaporan($jenisLaporan, $tanggalMulai, $tanggalSelesai);
        $title = 'Preview Laporan - ' . ucfirst($jenisLaporan);
        return view('admin.laporan.preview', compact(
            'data', 
            'jenisLaporan', 
            'periode', 
            'tanggalMulai', 
            'tanggalSelesai',
            'title'
        ));
    }
}