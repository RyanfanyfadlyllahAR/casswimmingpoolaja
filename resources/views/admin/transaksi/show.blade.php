<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-receipt"></i> {{ $title }}</h1>
                            <p class="mb-0">Detail lengkap transaksi pembayaran kursus.</p>
                        </div>
                        <div class="text-end">
                            <h4 class="mb-0">{{ $transaksi->order_id }}</h4>
                            <small>Order ID</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Transaksi
                </a>
                <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                    <i class="bi bi-pencil"></i> Update Status
                </button>
                <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-info" onclick="return confirm('Sinkronkan status dengan Midtrans?')">
                        <i class="bi bi-arrow-clockwise"></i> Sync Midtrans
                    </button>
                </form>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Detail Transaksi -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Order ID:</strong></td>
                                        <td><code>{{ $transaksi->order_id }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Transaksi:</strong></td>
                                        <td>{{ $transaksi->created_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Pembayaran:</strong></td>
                                        <td class="text-success"><strong>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Metode Pembayaran:</strong></td>
                                        <td>
                                            <span class="badge bg-primary">{{ ucfirst($transaksi->metode_pembayaran ?? 'Midtrans') }}</span>
                                            @if($transaksi->payment_type)
                                                <br><small class="text-muted">{{ ucfirst($transaksi->payment_type) }}</small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Pembayaran:</strong></td>
                                        <td>
                                            @if($transaksi->status_pembayaran == 'success' || $transaksi->status_pembayaran == 'capture')
                                                <span class="badge bg-success fs-6">Lunas</span>
                                            @elseif($transaksi->status_pembayaran == 'pending')
                                                <span class="badge bg-warning fs-6">Pending</span>
                                            @else
                                                <span class="badge bg-danger fs-6">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                            @endif
                                            
                                            @if($transaksi->updated_by_admin)
                                                <br><small class="text-info">*Diupdate oleh admin</small>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    @if($transaksi->transaction_time)
                                        <tr>
                                            <td><strong>Waktu Transaksi:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($transaksi->transaction_time)->format('d M Y H:i:s') }}</td>
                                        </tr>
                                    @endif
                                    @if($transaksi->settlement_time)
                                        <tr>
                                            <td><strong>Waktu Settlement:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($transaksi->settlement_time)->format('d M Y H:i:s') }}</td>
                                        </tr>
                                    @endif
                                    @if($transaksi->fraud_status)
                                        <tr>
                                            <td><strong>Status Fraud:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $transaksi->fraud_status == 'accept' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($transaksi->fraud_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($transaksi->snap_token)
                                        <tr>
                                            <td><strong>Snap Token:</strong></td>
                                            <td><small class="text-muted">{{ substr($transaksi->snap_token, 0, 20) }}...</small></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Last Update:</strong></td>
                                        <td>{{ $transaksi->updated_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($transaksi->catatan_admin)
                            <div class="alert alert-info mt-3">
                                <h6><i class="bi bi-sticky"></i> Catatan Admin:</h6>
                                <p class="mb-0">{{ $transaksi->catatan_admin }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Detail User -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Informasi User</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Nama Lengkap:</strong></td>
                                        <td>{{ $transaksi->user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td>{{ $transaksi->user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $transaksi->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>No. Telepon:</strong></td>
                                        <td>{{ $transaksi->user->no_telp ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $transaksi->user->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Member Since:</strong></td>
                                        <td>{{ $transaksi->user->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Kursus -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-water"></i> Detail Kursus & Jadwal</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">{{ $transaksi->kursus->nama_kursus }}</h6>
                        <p class="text-muted">{{ $transaksi->kursus->deskripsi }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="bi bi-info-circle"></i> Info Kursus</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $transaksi->kursus->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya:</strong></td>
                                        <td>Rp {{ number_format($transaksi->kursus->biaya, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Periode:</strong></td>
                                        <td>
                                            {{ $transaksi->kursus->tanggal_mulai->format('d M Y') }} - 
                                            {{ $transaksi->kursus->tanggal_selesai->format('d M Y') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-calendar3"></i> Info Jadwal</h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td><strong>Hari:</strong></td>
                                        <td><span class="badge bg-primary">{{ $transaksi->jadwal->hari }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jam:</strong></td>
                                        <td>
                                            {{ $transaksi->jadwal->jam_mulai->format('H:i') }} - 
                                            {{ $transaksi->jadwal->jam_selesai->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instruktur:</strong></td>
                                        <td>{{ $transaksi->jadwal->instruktur->nama_instruktur }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kapasitas:</strong></td>
                                        <td>{{ $transaksi->jadwal->kapasitas_maksimal }} orang</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-speedometer2"></i> Status Transaksi</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($transaksi->status_pembayaran == 'success' || $transaksi->status_pembayaran == 'capture')
                            <div class="bg-success text-white rounded p-4 mb-3">
                                <i class="bi bi-check-circle" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">LUNAS</h5>
                                <p class="mb-0">Pembayaran Berhasil</p>
                            </div>
                        @elseif($transaksi->status_pembayaran == 'pending')
                            <div class="bg-warning text-dark rounded p-4 mb-3">
                                <i class="bi bi-clock" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">PENDING</h5>
                                <p class="mb-0">Menunggu Pembayaran</p>
                            </div>
                        @else
                            <div class="bg-danger text-white rounded p-4 mb-3">
                                <i class="bi bi-x-circle" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">{{ strtoupper($transaksi->status_pembayaran) }}</h5>
                                <p class="mb-0">Pembayaran Gagal</p>
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                <i class="bi bi-pencil"></i> Update Status
                            </button>
                            <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info w-100" onclick="return confirm('Sinkronkan dengan Midtrans?')">
                                    <i class="bi bi-arrow-clockwise"></i> Sync Midtrans
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Peserta -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-person-badge"></i> Status Peserta</h6>
                    </div>
                    <div class="card-body">
                        @if($transaksi->peserta)
                            <div class="text-center">
                                <div class="mb-3">
                                    @if($transaksi->peserta->status == 'aktif')
                                        <span class="badge bg-success fs-6">Peserta Aktif</span>
                                    @elseif($transaksi->peserta->status == 'nonaktif')
                                        <span class="badge bg-warning fs-6">Belum Aktif</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Batal</span>
                                    @endif
                                </div>
                                <p><strong>Tanggal Daftar:</strong><br>{{ $transaksi->peserta->tanggal_daftar->format('d M Y') }}</p>
                                <p><strong>Status Pembayaran:</strong><br>
                                    <span class="badge bg-{{ $transaksi->peserta->status_pembayaran == 'lunas' ? 'success' : ($transaksi->peserta->status_pembayaran == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($transaksi->peserta->status_pembayaran) }}
                                    </span>
                                </p>
                            </div>
                        @else
                            <p class="text-muted text-center">Data peserta tidak ditemukan</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-link-45deg"></i> Quick Links</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.kursus.show', $transaksi->kursus) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-water"></i> Detail Kursus
                            </a>
                            <a href="{{ route('admin.jadwal.show', $transaksi->jadwal) }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-calendar3"></i> Detail Jadwal
                            </a>
                            <a href="{{ route('peserta.show', $transaksi->user) }}" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-person"></i> Profile User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Status -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.transaksi.update-status', $transaksi) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Order ID</label>
                            <input type="text" class="form-control" value="{{ $transaksi->order_id }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <input type="text" class="form-control" value="{{ $transaksi->user->nama_lengkap }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_pembayaran" required>
                                    <option value="pending" {{ $transaksi->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="success" {{ $transaksi->status_pembayaran == 'settlement' ? 'selected' : '' }}>Success (lunas)</option>
                                    <option value="expired" {{ $transaksi->status_pembayaran == 'expire' ? 'selected' : '' }}>Expired</option>
                                    <option value="failed" {{ $transaksi->status_pembayaran == 'failure' ? 'selected' : '' }}>Failed</option>
                            </select>
                            <small class="text-muted">Mengubah status akan mempengaruhi status peserta otomatis.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan Admin (Opsional)</label>
                            <textarea class="form-control" name="catatan" rows="3" placeholder="Tambahkan catatan untuk perubahan status...">{{ $transaksi->catatan_admin }}</textarea>
                        </div>

                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>Perhatian:</strong> Mengubah status pembayaran akan mempengaruhi status peserta secara otomatis.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>