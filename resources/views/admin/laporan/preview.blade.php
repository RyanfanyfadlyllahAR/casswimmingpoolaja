<x-layout>
    <x-slot:title>Preview Laporan - {{ ucfirst($jenisLaporan) }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-eye"></i> Preview Laporan {{ ucfirst($jenisLaporan) }}</h1>
                            <p class="mb-0">Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') }}</p>
                        </div>
                        <div class="text-end">
                            <small class="d-block">Digenerate: {{ now()->format('d M Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.laporan') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Laporan
                </a>
                <button class="btn btn-primary" onclick="downloadPDF()">
                    <i class="bi bi-download"></i> Download PDF
                </button>
                <button class="btn btn-success" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>
        </div>

        @if($jenisLaporan == 'lengkap')
            <!-- Laporan Lengkap -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Umum</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-primary">{{ $data['statistik']['total_users'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Users</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-success">{{ $data['statistik']['total_peserta'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Peserta</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-info">{{ $data['statistik']['total_transaksi'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Transaksi</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-warning">Rp {{ number_format($data['statistik']['total_pendapatan'] ?? 0, 0, ',', '.') }}</h3>
                                        <small class="text-muted">Total Pendapatan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Peserta -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-people"></i> Data Peserta ({{ $data['peserta']->count() ?? 0 }} orang)</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['peserta']) && $data['peserta']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Email</th>
                                                <th>Kursus</th>
                                                <th>Jadwal</th>
                                                <th>Status</th>
                                                <th>Tanggal Daftar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['peserta'] as $index => $peserta)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <strong>{{ $peserta->user->nama_lengkap ?? 'N/A' }}</strong><br>
                                                        <small class="text-muted">{{ $peserta->user->username ?? 'N/A' }}</small>
                                                    </td>
                                                    <td>{{ $peserta->user->email ?? 'N/A' }}</td>
                                                    <td>{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</td>
                                                    <td>
                                                        {{ $peserta->jadwal->hari ?? 'N/A' }}<br>
                                                        <small class="text-muted">
                                                            @if($peserta->jadwal)
                                                                {{ $peserta->jadwal->jam_mulai->format('H:i') }}-{{ $peserta->jadwal->jam_selesai->format('H:i') }}
                                                            @endif
                                                        </small>
                                                    </td>
                                                    <td>
                                                        @if($peserta->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @elseif($peserta->status == 'selesai')
                                                            <span class="badge bg-primary">Selesai</span>
                                                        @elseif($peserta->status == 'batal')
                                                            <span class="badge bg-danger">Batal</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ ucfirst($peserta->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $peserta->tanggal_daftar ? \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d M Y') : 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-person-x text-muted" style="font-size: 3rem;"></i>
                                    <h6 class="mt-3">Tidak Ada Data Peserta</h6>
                                    <p class="text-muted">Tidak ada data peserta pada periode ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Transaksi -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-credit-card"></i> Data Transaksi ({{ $data['transaksi']->count() ?? 0 }} transaksi)</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['transaksi']) && $data['transaksi']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
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
                                                    <td><code>{{ $transaksi->order_id }}</code></td>
                                                    <td>{{ $transaksi->user->nama_lengkap ?? 'N/A' }}</td>
                                                    <td>{{ $transaksi->kursus->nama_kursus ?? 'N/A' }}</td>
                                                    <td>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if(in_array($transaksi->status_pembayaran, ['success', 'capture']))
                                                            <span class="badge bg-success">Lunas</span>
                                                        @elseif($transaksi->status_pembayaran == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-credit-card-2-front text-muted" style="font-size: 3rem;"></i>
                                    <h6 class="mt-3">Tidak Ada Data Transaksi</h6>
                                    <p class="text-muted">Tidak ada data transaksi pada periode ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Kursus & Instruktur -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-water"></i> Data Kursus ({{ $data['kursus']->count() ?? 0 }} kursus)</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['kursus']) && $data['kursus']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nama Kursus</th>
                                                <th>Biaya</th>
                                                <th>Peserta</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['kursus'] as $kursus)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $kursus->nama_kursus }}</strong><br>
                                                        <small class="text-muted">{{ $kursus->durasi }}</small>
                                                    </td>
                                                    <td>Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $kursus->pesertas_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        @if($kursus->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="bi bi-water text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0 text-muted">Tidak ada data kursus</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-person-check"></i> Data Instruktur ({{ $data['instruktur']->count() ?? 0 }} instruktur)</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['instruktur']) && $data['instruktur']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nama Instruktur</th>
                                                <th>Pengalaman</th>
                                                <th>Jadwal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['instruktur'] as $instruktur)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $instruktur->nama_instruktur }}</strong><br>
                                                        <small class="text-muted">{{ $instruktur->spesialisasi ?? 'N/A' }}</small>
                                                    </td>
                                                    <td>{{ $instruktur->pengalaman ?? 0 }} tahun</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $instruktur->jadwals_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        @if($instruktur->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="bi bi-person-check text-muted" style="font-size: 2rem;"></i>
                                    <p class="mt-2 mb-0 text-muted">Tidak ada data instruktur</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @elseif($jenisLaporan == 'peserta')
            <!-- Laporan Khusus Peserta -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Peserta</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-primary">{{ $data['statistik']['total_peserta'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Peserta</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-success">{{ $data['statistik']['peserta_aktif'] ?? 0 }}</h3>
                                        <small class="text-muted">Peserta Aktif</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-info">{{ $data['statistik']['peserta_selesai'] ?? 0 }}</h3>
                                        <small class="text-muted">Peserta Selesai</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-danger">{{ $data['statistik']['peserta_batal'] ?? 0 }}</h3>
                                        <small class="text-muted">Peserta Batal</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Data Peserta -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-people"></i> Detail Data Peserta</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['peserta']) && $data['peserta']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Email</th>
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
                                                    <td>
                                                        <strong>{{ $peserta->user->nama_lengkap ?? 'N/A' }}</strong><br>
                                                        <small class="text-muted">{{ $peserta->user->no_telp ?? 'N/A' }}</small>
                                                    </td>
                                                    <td>{{ $peserta->user->email ?? 'N/A' }}</td>
                                                    <td>{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</td>
                                                    <td>
                                                        {{ $peserta->jadwal->hari ?? 'N/A' }}<br>
                                                        <small class="text-muted">
                                                            @if($peserta->jadwal)
                                                                {{ $peserta->jadwal->jam_mulai->format('H:i') }}-{{ $peserta->jadwal->jam_selesai->format('H:i') }}
                                                            @endif
                                                        </small>
                                                    </td>
                                                    <td>{{ $peserta->jadwal->instruktur->nama_instruktur ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($peserta->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @elseif($peserta->status == 'selesai')
                                                            <span class="badge bg-primary">Selesai</span>
                                                        @elseif($peserta->status == 'batal')
                                                            <span class="badge bg-danger">Batal</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ ucfirst($peserta->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $peserta->tanggal_daftar ? \Carbon\Carbon::parse($peserta->tanggal_daftar)->format('d M Y') : 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-person-x text-muted" style="font-size: 4rem;"></i>
                                    <h5 class="mt-3">Tidak Ada Data Peserta</h5>
                                    <p class="text-muted">Tidak ada data peserta pada periode ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @elseif($jenisLaporan == 'transaksi')
            <!-- Laporan Khusus Transaksi -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-primary">{{ $data['statistik']['total_transaksi'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Transaksi</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-success">Rp {{ number_format($data['statistik']['total_pendapatan'] ?? 0, 0, ',', '.') }}</h3>
                                        <small class="text-muted">Total Pendapatan</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-info">{{ $data['statistik']['transaksi_lunas'] ?? 0 }}</h3>
                                        <small class="text-muted">Transaksi Lunas</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-warning">{{ $data['statistik']['transaksi_pending'] ?? 0 }}</h3>
                                        <small class="text-muted">Transaksi Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Data Transaksi -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-credit-card"></i> Detail Data Transaksi</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['transaksi']) && $data['transaksi']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
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
                                                    <td><code>{{ $transaksi->order_id }}</code></td>
                                                    <td>{{ $transaksi->user->nama_lengkap ?? 'N/A' }}</td>
                                                    <td>{{ $transaksi->kursus->nama_kursus ?? 'N/A' }}</td>
                                                    <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
                                                    <td>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if(in_array($transaksi->status_pembayaran, ['settlement', 'capture']))
                                                            <span class="badge bg-success">Lunas</span>
                                                        @elseif($transaksi->status_pembayaran == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-credit-card-2-front text-muted" style="font-size: 4rem;"></i>
                                    <h5 class="mt-3">Tidak Ada Data Transaksi</h5>
                                    <p class="text-muted">Tidak ada data transaksi pada periode ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @elseif($jenisLaporan == 'kursus')
            <!-- Laporan Khusus Kursus -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Kursus</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-primary">{{ $data['statistik']['total_kursus'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Kursus</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-success">{{ $data['statistik']['kursus_aktif'] ?? 0 }}</h3>
                                        <small class="text-muted">Kursus Aktif</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-secondary">{{ $data['statistik']['kursus_nonaktif'] ?? 0 }}</h3>
                                        <small class="text-muted">Kursus Nonaktif</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Data Kursus -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-water"></i> Detail Data Kursus</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['kursus']) && $data['kursus']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
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
                                                    <td>
                                                        <strong>{{ $kursus->nama_kursus }}</strong><br>
                                                        <small class="text-muted">{{ Str::limit($kursus->deskripsi, 50) }}</small>
                                                    </td>
                                                    <td>{{ $kursus->durasi }}</td>
                                                    <td>Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $kursus->pesertas_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">{{ $kursus->pesertas_aktif_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $kursus->pesertas_selesai_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        @if($kursus->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $kursus->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-water text-muted" style="font-size: 4rem;"></i>
                                    <h5 class="mt-3">Tidak Ada Data Kursus</h5>
                                    <p class="text-muted">Tidak ada data kursus.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @elseif($jenisLaporan == 'instruktur')
            <!-- Laporan Khusus Instruktur -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik Instruktur</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-primary">{{ $data['statistik']['total_instruktur'] ?? 0 }}</h3>
                                        <small class="text-muted">Total Instruktur</small>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <h3 class="text-success">{{ $data['statistik']['instruktur_aktif'] ?? 0 }}</h3>
                                        <small class="text-muted">Instruktur Aktif</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Data Instruktur -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-person-check"></i> Detail Data Instruktur</h5>
                        </div>
                        <div class="card-body">
                            @if(isset($data['instruktur']) && $data['instruktur']->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Instruktur</th>
                                                <th>Email</th>
                                                <th>No. Telp</th>
                                                <th>Spesialisasi</th>
                                                <th>Pengalaman</th>
                                                <th>Total Jadwal</th>
                                                <th>Status</th>
                                                <th>Bergabung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['instruktur'] as $index => $instruktur)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <strong>{{ $instruktur->nama_instruktur }}</strong>
                                                    </td>
                                                    <td>{{ $instruktur->email ?? 'N/A' }}</td>
                                                    <td>{{ $instruktur->no_telp ?? 'N/A' }}</td>
                                                    <td>{{ $instruktur->spesialisasi ?? 'N/A' }}</td>
                                                    <td>{{ $instruktur->pengalaman ?? 0 }} tahun</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $instruktur->jadwals_count ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        @if($instruktur->status == 'aktif')
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-secondary">Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $instruktur->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-person-check text-muted" style="font-size: 4rem;"></i>
                                    <h5 class="mt-3">Tidak Ada Data Instruktur</h5>
                                    <p class="text-muted">Tidak ada data instruktur.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Footer Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <small class="text-muted">
                            © {{ date('Y') }} CAS Swimming Pool - Laporan digenerate pada {{ now()->format('d M Y H:i:s') }} oleh {{ Auth::user()->nama_lengkap }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .btn, .card-header, .nav, .navbar { 
                display: none !important; 
            }
            .card {
                border: 1px solid #ddd !important;
                margin-bottom: 15px !important;
            }
        }
    </style>

    <script>
        function downloadPDF() {
            // Redirect untuk download PDF dengan parameter yang sama
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.laporan.generate") }}';
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            // Add parameters
            const jenisLaporan = document.createElement('input');
            jenisLaporan.type = 'hidden';
            jenisLaporan.name = 'jenis_laporan';
            jenisLaporan.value = '{{ $jenisLaporan }}';
            form.appendChild(jenisLaporan);
            
            const periode = document.createElement('input');
            periode.type = 'hidden';
            periode.name = 'periode';
            periode.value = '{{ $periode }}';
            form.appendChild(periode);
            
            const tanggalMulai = document.createElement('input');
            tanggalMulai.type = 'hidden';
            tanggalMulai.name = 'tanggal_mulai';
            tanggalMulai.value = '{{ $tanggalMulai }}';
            form.appendChild(tanggalMulai);
            
            const tanggalSelesai = document.createElement('input');
            tanggalSelesai.type = 'hidden';
            tanggalSelesai.name = 'tanggal_selesai';
            tanggalSelesai.value = '{{ $tanggalSelesai }}';
            form.appendChild(tanggalSelesai);
            
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
</x-layout>