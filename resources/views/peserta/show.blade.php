<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-person-circle"></i> {{ $title }}</h1>
                            <p class="mb-0">Detail lengkap informasi peserta dan status pendaftaran.</p>
                        </div>
                        <div class="text-end">
                            @if($peserta->status == 'aktif')
                                <span class="badge bg-success fs-6">AKTIF</span>
                            @elseif($peserta->status == 'nonaktif')
                                <span class="badge bg-warning fs-6">PENDING</span>
                            @elseif($peserta->status == 'selesai')
                                <span class="badge bg-primary fs-6">SELESAI</span>
                            @else
                                <span class="badge bg-danger fs-6">BATAL</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Peserta
                </a>
                <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Edit Peserta
                </a>
                @if($peserta->transaksi)
                    <a href="{{ route('admin.transaksi.show', $peserta->transaksi) }}" class="btn btn-info">
                        <i class="bi bi-credit-card"></i> Lihat Transaksi
                    </a>
                @endif
            </div>
        </div>

        <!-- Detail Peserta -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Info User -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Informasi Peserta</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama Lengkap:</strong></td>
                                        <td>{{ $peserta->user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td>{{ $peserta->user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $peserta->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No. Telepon:</strong></td>
                                        <td>{{ $peserta->user->no_telp ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $peserta->user->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Member Since:</strong></td>
                                        <td>{{ $peserta->user->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Kursus -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-water"></i> Detail Kursus & Jadwal</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">{{ $peserta->kursus->nama_kursus }}</h6>
                        <p class="text-muted">{{ $peserta->kursus->deskripsi }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="bi bi-info-circle"></i> Info Kursus</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $peserta->kursus->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya:</strong></td>
                                        <td>Rp {{ number_format($peserta->kursus->biaya, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Periode:</strong></td>
                                        <td>
                                            {{ $peserta->kursus->tanggal_mulai->format('d M Y') }} - 
                                            {{ $peserta->kursus->tanggal_selesai->format('d M Y') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-calendar3"></i> Info Jadwal</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Hari:</strong></td>
                                        <td><span class="badge bg-primary">{{ $peserta->jadwal->hari }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jam:</strong></td>
                                        <td>
                                            {{ $peserta->jadwal->jam_mulai->format('H:i') }} - 
                                            {{ $peserta->jadwal->jam_selesai->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instruktur:</strong></td>
                                        <td>{{ $peserta->jadwal->instruktur->nama_instruktur }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kapasitas:</strong></td>
                                        <td>{{ $peserta->jadwal->kapasitas_maksimal }} orang</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Transaksi -->
                @if($peserta->transaksi)
                    <div class="card shadow mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-credit-card"></i> Informasi Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Order ID:</strong></td>
                                            <td><code>{{ $peserta->transaksi->order_id }}</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah:</strong></td>
                                            <td class="text-success"><strong>Rp {{ number_format($peserta->transaksi->jumlah, 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                @if($peserta->transaksi->status_pembayaran == 'settlement' || $peserta->transaksi->status_pembayaran == 'capture')
                                                    <span class="badge bg-success">Lunas</span>
                                                @elseif($peserta->transaksi->status_pembayaran == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">{{ ucfirst($peserta->transaksi->status_pembayaran) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal:</strong></td>
                                            <td>{{ $peserta->transaksi->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('admin.transaksi.show', $peserta->transaksi) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat Detail Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card shadow mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-credit-card"></i> Informasi Transaksi</h5>
                        </div>
                        <div class="card-body text-center">
                            <i class="bi bi-credit-card-2-front text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3">Belum Ada Transaksi</h6>
                            <p class="text-muted">Peserta ini belum melakukan transaksi pembayaran.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-speedometer2"></i> Status Peserta</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($peserta->status == 'aktif')
                            <div class="bg-success text-white rounded p-4 mb-3">
                                <i class="bi bi-person-check" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">AKTIF</h5>
                                <p class="mb-0">Sedang mengikuti kursus</p>
                            </div>
                        @elseif($peserta->status == 'nonaktif')
                            <div class="bg-warning text-dark rounded p-4 mb-3">
                                <i class="bi bi-clock" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">PENDING</h5>
                                <p class="mb-0">Menunggu aktivasi</p>
                            </div>
                        @elseif($peserta->status == 'selesai')
                            <div class="bg-primary text-white rounded p-4 mb-3">
                                <i class="bi bi-trophy" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">SELESAI</h5>
                                <p class="mb-0">Kursus telah selesai</p>
                            </div>
                        @else
                            <div class="bg-danger text-white rounded p-4 mb-3">
                                <i class="bi bi-x-circle" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">BATAL</h5>
                                <p class="mb-0">Kursus dibatalkan</p>
                            </div>
                        @endif

                        <p><strong>Tanggal Daftar:</strong><br>{{ $peserta->tanggal_daftar->format('d M Y') }}</p>
                        <p><strong>Status Pembayaran:</strong><br>
                            <span class="badge bg-{{ $peserta->status_pembayaran == 'lunas' ? 'success' : ($peserta->status_pembayaran == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($peserta->status_pembayaran) }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-lightning"></i> Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit Peserta
                            </a>
                            <a href="{{ route('admin.kursus.show', $peserta->kursus) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-water"></i> Detail Kursus
                            </a>
                            <a href="{{ route('admin.jadwal.show', $peserta->jadwal) }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-calendar3"></i> Detail Jadwal
                            </a>
                            @if($peserta->transaksi)
                                <a href="{{ route('admin.transaksi.show', $peserta->transaksi) }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-credit-card"></i> Detail Transaksi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Timeline (opsional) -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-clock-history"></i> Timeline</h6>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <small class="text-muted">{{ $peserta->created_at->diffForHumans() }}</small>
                                    <p class="mb-0">Peserta terdaftar</p>
                                </div>
                            </div>
                            @if($peserta->transaksi)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-{{ $peserta->transaksi->status_pembayaran == 'settlement' ? 'success' : 'warning' }}"></div>
                                    <div class="timeline-content">
                                        <small class="text-muted">{{ $peserta->transaksi->created_at->diffForHumans() }}</small>
                                        <p class="mb-0">Transaksi {{ $peserta->transaksi->status_pembayaran }}</p>
                                    </div>
                                </div>
                            @endif
                            @if($peserta->status == 'aktif')
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <small class="text-muted">{{ $peserta->updated_at->diffForHumans() }}</small>
                                        <p class="mb-0">Status aktif</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 20px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 15px;
        }
        
        .timeline-marker {
            position: absolute;
            left: -16px;
            top: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        
        .timeline-content {
            margin-left: 5px;
        }
    </style>
</x-layout>