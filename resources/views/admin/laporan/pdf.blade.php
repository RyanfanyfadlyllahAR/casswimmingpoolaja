<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan CAS Swimming Pool</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin: 0; 
            padding: 20px; 
        }
        .header { 
            text-align: center; 
            border-bottom: 2px solid #333; 
            padding-bottom: 15px; 
            margin-bottom: 20px; 
        }
        .header h1 { 
            margin: 0; 
            color: #333; 
            font-size: 24px; 
        }
        .header p { 
            margin: 5px 0; 
            color: #666; 
        }
        .info-box { 
            background: #f8f9fa; 
            border: 1px solid #dee2e6; 
            border-radius: 5px; 
            padding: 15px; 
            margin-bottom: 20px; 
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stats-row {
            display: table-row;
        }
        .stats-cell {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background: #f8f9fa;
        }
        .stats-number {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .stats-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold; 
        }
        .section-title { 
            font-size: 16px; 
            font-weight: bold; 
            margin: 25px 0 10px 0; 
            padding: 8px; 
            background: #007bff; 
            color: white; 
            border-radius: 3px; 
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success { background: #28a745; color: white; }
        .badge-warning { background: #ffc107; color: #212529; }
        .badge-danger { background: #dc3545; color: white; }
        .badge-info { background: #17a2b8; color: white; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding: 10px;
            background: white;
        }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>CAS SWIMMING POOL</h1>
        <p>Jl. Contoh Alamat No. 123, Kota, Provinsi</p>
        <p>Telp: (021) 1234-5678 | Email: info@casswimmingpool.com</p>
        <h2 style="margin-top: 15px; color: #007bff;">
            {{ ucfirst($jenisLaporan) == 'Lengkap' ? 'LAPORAN LENGKAP SISTEM' : 'LAPORAN ' . strtoupper($jenisLaporan) }}
        </h2>
        <p>Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') }}</p>
        <p>Digenerate pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <strong>Informasi Laporan:</strong><br>
        <strong>Jenis:</strong> {{ ucfirst($jenisLaporan) }}<br>
        <strong>Periode:</strong> {{ $periode }}<br>
        <strong>Range Tanggal:</strong> {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') }}<br>
        <strong>Administrator:</strong> {{ Auth::user()->nama_lengkap }}
    </div>

    @if($jenisLaporan == 'lengkap')
        <!-- Statistik Umum -->
        <div class="section-title">STATISTIK UMUM</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_users'] ?? 0 }}</div>
                    <div class="stats-label">Total Users</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_peserta'] ?? 0 }}</div>
                    <div class="stats-label">Total Peserta</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_transaksi'] ?? 0 }}</div>
                    <div class="stats-label">Total Transaksi</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">Rp {{ number_format($data['statistik']['total_pendapatan'] ?? 0, 0, ',', '.') }}</div>
                    <div class="stats-label">Total Pendapatan</div>
                </div>
            </div>
        </div>

        <!-- Data Peserta -->
        <div class="section-title">DATA PESERTA</div>
        @if(isset($data['peserta']) && $data['peserta']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Kursus</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['peserta'] as $index => $peserta)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peserta->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $peserta->user->email ?? 'N/A' }}</td>
                            <td>{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</td>
                            <td>
                                @if($peserta->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($peserta->status == 'selesai')
                                    <span class="badge badge-info">Selesai</span>
                                @else
                                    <span class="badge badge-warning">{{ ucfirst($peserta->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $peserta->tanggal_daftar ? \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d M Y') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data peserta pada periode ini.</p>
        @endif

        <div class="page-break"></div>

        <!-- Data Transaksi -->
        <div class="section-title">DATA TRANSAKSI & PEMBAYARAN</div>
        @if(isset($data['transaksi']) && $data['transaksi']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Kursus</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['transaksi'] as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksi->order_id }}</td>
                            <td>{{ $transaksi->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $transaksi->kursus->nama_kursus ?? 'N/A' }}</td>
                            <td class="text-right">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                            <td>
                                @if(in_array($transaksi->status_pembayaran, ['settlement', 'capture']))
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($transaksi->status_pembayaran == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                @endif
                            </td>
                            <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data transaksi pada periode ini.</p>
        @endif

        <!-- Data Kursus -->
        <div class="section-title">DATA KURSUS</div>
        @if(isset($data['kursus']) && $data['kursus']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kursus</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                        <th>Total Peserta</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['kursus'] as $index => $kursus)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kursus->nama_kursus }}</td>
                            <td>{{ $kursus->durasi }}</td>
                            <td class="text-right">Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $kursus->pesertas_count ?? 0 }}</td>
                            <td>
                                @if($kursus->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data kursus.</p>
        @endif

        <!-- Data Instruktur -->
        <div class="section-title">DATA INSTRUKTUR</div>
        @if(isset($data['instruktur']) && $data['instruktur']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Instruktur</th>
                        <th>Spesialisasi</th>
                        <th>Total Jadwal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['instruktur'] as $index => $instruktur)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $instruktur->nama_instruktur }}</td>
                            <td>{{ $instruktur->spesialisasi ?? 'N/A' }}</td>
                            <td class="text-center">{{ $instruktur->jadwals_count ?? 0 }}</td>
                            <td>
                                @if($instruktur->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data instruktur.</p>
        @endif

    @elseif($jenisLaporan == 'peserta')
        <!-- Laporan Khusus Peserta -->
        <div class="section-title">STATISTIK PESERTA</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_peserta'] ?? 0 }}</div>
                    <div class="stats-label">Total Peserta</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['peserta_aktif'] ?? 0 }}</div>
                    <div class="stats-label">Peserta Aktif</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['peserta_selesai'] ?? 0 }}</div>
                    <div class="stats-label">Peserta Selesai</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['peserta_batal'] ?? 0 }}</div>
                    <div class="stats-label">Peserta Batal</div>
                </div>
            </div>
        </div>

        <div class="section-title">DETAIL DATA PESERTA</div>
        @if(isset($data['peserta']) && $data['peserta']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Kursus</th>
                        <th>Jadwal</th>
                        <th>Instruktur</th>
                        <th>Status</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['peserta'] as $index => $peserta)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $peserta->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $peserta->user->email ?? 'N/A' }}</td>
                            <td>{{ $peserta->user->no_telp ?? 'N/A' }}</td>
                            <td>{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</td>
                            <td>{{ $peserta->jadwal->hari ?? 'N/A' }}, {{ $peserta->jadwal ? $peserta->jadwal->jam_mulai->format('H:i') : 'N/A' }}</td>
                            <td>{{ $peserta->jadwal->instruktur->nama_instruktur ?? 'N/A' }}</td>
                            <td>
                                @if($peserta->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($peserta->status == 'selesai')
                                    <span class="badge badge-info">Selesai</span>
                                @elseif($peserta->status == 'batal')
                                    <span class="badge badge-danger">Batal</span>
                                @else
                                    <span class="badge badge-warning">{{ ucfirst($peserta->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $peserta->tanggal_daftar ? \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d M Y') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data peserta pada periode ini.</p>
        @endif

    @elseif($jenisLaporan == 'transaksi')
        <!-- Laporan Khusus Transaksi -->
        <div class="section-title">STATISTIK TRANSAKSI</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_transaksi'] ?? 0 }}</div>
                    <div class="stats-label">Total Transaksi</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">Rp {{ number_format($data['statistik']['total_pendapatan'] ?? 0, 0, ',', '.') }}</div>
                    <div class="stats-label">Total Pendapatan</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['transaksi_lunas'] ?? 0 }}</div>
                    <div class="stats-label">Transaksi Lunas</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['transaksi_pending'] ?? 0 }}</div>
                    <div class="stats-label">Transaksi Pending</div>
                </div>
            </div>
        </div>

        <div class="section-title">DETAIL DATA TRANSAKSI</div>
        @if(isset($data['transaksi']) && $data['transaksi']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Kursus</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['transaksi'] as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksi->order_id }}</td>
                            <td>{{ $transaksi->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $transaksi->kursus->nama_kursus ?? 'N/A' }}</td>
                            <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
                            <td class="text-right">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                            <td>
                                @if(in_array($transaksi->status_pembayaran, ['settlement', 'capture']))
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($transaksi->status_pembayaran == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                @endif
                            </td>
                            <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data transaksi pada periode ini.</p>
        @endif

    @elseif($jenisLaporan == 'kursus')
        <!-- Laporan Khusus Kursus -->
        <div class="section-title">STATISTIK KURSUS</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_kursus'] ?? 0 }}</div>
                    <div class="stats-label">Total Kursus</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['kursus_aktif'] ?? 0 }}</div>
                    <div class="stats-label">Kursus Aktif</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['kursus_nonaktif'] ?? 0 }}</div>
                    <div class="stats-label">Kursus Nonaktif</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">-</div>
                    <div class="stats-label">-</div>
                </div>
            </div>
        </div>

        <div class="section-title">DETAIL DATA KURSUS</div>
        @if(isset($data['kursus']) && $data['kursus']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kursus</th>
                        <th>Durasi</th>
                        <th>Biaya</th>
                        <th>Total Peserta</th>
                        <th>Peserta Aktif</th>
                        <th>Peserta Selesai</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['kursus'] as $index => $kursus)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kursus->nama_kursus }}</td>
                            <td>{{ $kursus->durasi }}</td>
                            <td class="text-right">Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $kursus->pesertas_count ?? 0 }}</td>
                            <td class="text-center">{{ $kursus->pesertas_aktif_count ?? 0 }}</td>
                            <td class="text-center">{{ $kursus->pesertas_selesai_count ?? 0 }}</td>
                            <td>
                                @if($kursus->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $kursus->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data kursus.</p>
        @endif

    @elseif($jenisLaporan == 'instruktur')
        <!-- Laporan Khusus Instruktur -->
        <div class="section-title">STATISTIK INSTRUKTUR</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['total_instruktur'] ?? 0 }}</div>
                    <div class="stats-label">Total Instruktur</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">{{ $data['statistik']['instruktur_aktif'] ?? 0 }}</div>
                    <div class="stats-label">Instruktur Aktif</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">-</div>
                    <div class="stats-label">-</div>
                </div>
                <div class="stats-cell">
                    <div class="stats-number">-</div>
                    <div class="stats-label">-</div>
                </div>
            </div>
        </div>

        <div class="section-title">DETAIL DATA INSTRUKTUR</div>
        @if(isset($data['instruktur']) && $data['instruktur']->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Instruktur</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Spesialisasi</th>
                        <th>Total Jadwal</th>
                        <th>Status</th>
                        <th>Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['instruktur'] as $index => $instruktur)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $instruktur->nama_instruktur }}</td>
                            <td>{{ $instruktur->email ?? 'N/A' }}</td>
                            <td>{{ $instruktur->no_telp ?? 'N/A' }}</td>
                            <td>{{ $instruktur->spesialisasi ?? 'N/A' }}</td>
                            <td class="text-center">{{ $instruktur->jadwals_count ?? 0 }}</td>
                            <td>
                                @if($instruktur->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-warning">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $instruktur->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data instruktur.</p>
        @endif
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>© {{ date('Y') }} CAS Swimming Pool - Laporan digenerate pada {{ now()->format('d M Y H:i:s') }} oleh {{ Auth::user()->nama_lengkap }}</p>
    </div>
</body>
</html>