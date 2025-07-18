<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
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
                <button class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editStatusModal">
                    <i class="bi bi-pencil"></i> Update Status
                </button>
                <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="button" class="btn btn-info sync-btn" data-order-id="{{ $transaksi->order_id }}">
                        <i class="bi bi-arrow-clockwise"></i> Sync Midtrans
                    </button>
                </form>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle"></i> {{ session('info') }}
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
                                            @elseif($transaksi->status_pembayaran == 'expired')
                                                <span class="badge bg-secondary fs-6">Expired</span>
                                            @elseif($transaksi->status_pembayaran == 'failed')
                                                <span class="badge bg-danger fs-6">Failed</span>
                                            @else
                                                <span class="badge bg-dark fs-6">{{ ucfirst($transaksi->status_pembayaran) }}</span>
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
                        @elseif($transaksi->status_pembayaran == 'expired')
                            <div class="bg-secondary text-white rounded p-4 mb-3">
                                <i class="bi bi-clock-history" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">EXPIRED</h5>
                                <p class="mb-0">Pembayaran Kedaluwarsa</p>
                            </div>
                        @elseif($transaksi->status_pembayaran == 'failed')
                            <div class="bg-danger text-white rounded p-4 mb-3">
                                <i class="bi bi-x-circle" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">FAILED</h5>
                                <p class="mb-0">Pembayaran Gagal</p>
                            </div>
                        @else
                            <div class="bg-dark text-white rounded p-4 mb-3">
                                <i class="bi bi-question-circle" style="font-size: 3rem;"></i>
                                <h5 class="mt-2">{{ strtoupper($transaksi->status_pembayaran) }}</h5>
                                <p class="mb-0">Status Tidak Diketahui</p>
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button class="btn btn-warning edit-status-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editStatusModal"
                                    data-transaksi-id="{{ $transaksi->id }}"
                                    data-order-id="{{ $transaksi->order_id }}"
                                    data-customer="{{ $transaksi->user->nama_lengkap }}"
                                    data-email="{{ $transaksi->user->email }}"
                                    data-jumlah="{{ $transaksi->jumlah }}"
                                    data-kursus="{{ $transaksi->kursus->nama_kursus }}"
                                    data-status="{{ $transaksi->status_pembayaran }}"
                                    data-catatan="{{ $transaksi->catatan_admin ?? '' }}">
                                <i class="bi bi-pencil"></i> Update Status
                            </button>
                            <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST">
                                @csrf
                                <button type="button" class="btn btn-info w-100 sync-btn" data-order-id="{{ $transaksi->order_id }}">
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

    <!-- MODAL UPDATE STATUS - SAMA DENGAN INDEX -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content admin-modal-content">
                <div class="modal-header admin-modal-header">
                    <h5 class="modal-title" id="editStatusModalLabel">
                        <i class="bi bi-pencil-square"></i> Update Status Pembayaran
                    </h5>
                    <button type="button" class="btn-close admin-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editStatusForm" method="POST" action="" class="admin-form">
                    @csrf
                    @method('PUT')

                    <div class="modal-body admin-modal-body">
                        <!-- Info Transaksi -->
                        <div class="card border-info mb-3 admin-info-card">
                            <div class="card-header bg-light admin-info-header">
                                <h6 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Transaksi</h6>
                            </div>
                            <div class="card-body admin-info-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="admin-info-text"><strong>Order ID:</strong> <span id="adminModalOrderId">-</span></p>
                                        <p class="admin-info-text"><strong>Customer:</strong> <span id="adminModalCustomer">-</span></p>
                                        <p class="admin-info-text"><strong>Email:</strong> <span id="adminModalEmail">-</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="admin-info-text"><strong>Kursus:</strong> <span id="adminModalKursus">-</span></p>
                                        <p class="admin-info-text"><strong>Jumlah:</strong> <span id="adminModalJumlah">-</span></p>
                                        <p class="admin-info-text"><strong>Status Saat Ini:</strong> <span id="adminModalCurrentStatus">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Update -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="adminStatusSelect" class="form-label admin-form-label">
                                    <strong>Status Pembayaran Baru</strong> <span class="text-danger">*</span>
                                </label>
                                <select class="form-select admin-form-select" id="adminStatusSelect" name="status_pembayaran" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="success">Success (Lunas)</option>
                                    <option value="expired">Expired</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label admin-form-label"><strong>Preview Status</strong></label>
                                <div class="border rounded p-2 text-center admin-status-preview" id="adminStatusPreview">
                                    <span class="text-muted">Pilih status</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="adminModalCatatan" class="form-label admin-form-label"><strong>Catatan Admin</strong></label>
                            <textarea class="form-control admin-form-textarea" id="adminModalCatatan" name="catatan" rows="3" placeholder="Tambahkan catatan admin (opsional)..."></textarea>
                        </div>

                        <div class="alert alert-warning admin-warning-alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>Perhatian!</strong> Perubahan status akan mempengaruhi akses kursus customer.
                        </div>
                    </div>

                    <div class="modal-footer admin-modal-footer">
                        <button type="button" class="btn btn-secondary admin-btn-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary admin-btn-save" id="adminBtnSaveStatus">
                            <i class="bi bi-check"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- MODAL KONFIRMASI SINKRONISASI -->
    <div class="modal fade" id="syncConfirmModal" tabindex="-1" aria-labelledby="syncConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="syncConfirmModalLabel">
                        <i class="bi bi-arrow-clockwise"></i> Konfirmasi Sinkronisasi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-arrow-clockwise text-info" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="text-center mb-3">Sinkronisasi Status Pembayaran</h6>
                    <div class="alert alert-info">
                        <p class="mb-2"><strong>Order ID:</strong> <span id="syncOrderId">-</span></p>
                        <p class="mb-0"><strong>Customer:</strong> <span id="syncCustomer">-</span></p>
                    </div>
                    <p class="text-muted text-center">
                        Proses ini akan mengambil status terbaru dari server Midtrans dan memperbarui data transaksi.
                    </p>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Perhatian:</strong> Status pembayaran akan diperbarui sesuai dengan data dari Midtrans.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i> Batal
                    </button>
                    <button type="button" class="btn btn-info" id="confirmSyncBtn">
                        <i class="bi bi-arrow-clockwise"></i> Ya, Sinkronkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<!-- CSS STYLES - SAMA DENGAN INDEX -->
<style>
/* ADMIN MODAL SPECIFIC STYLES */
#editStatusModal {
    z-index: 1060 !important;
}

#editStatusModal .modal-backdrop {
    z-index: 1055 !important;
}

.admin-modal-content {
    border: none !important;
    border-radius: 12px !important;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
    background: #ffffff !important;
}

.admin-modal-header {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
    color: white !important;
    border-top-left-radius: 12px !important;
    border-top-right-radius: 12px !important;
    border-bottom: none !important;
}

.admin-btn-close {
    filter: brightness(0) invert(1) !important;
    opacity: 1 !important;
}

.admin-modal-body {
    padding: 1.5rem !important;
    background: #f8f9fa !important;
}

.admin-info-card {
    border: 1px solid #17a2b8 !important;
    border-radius: 8px !important;
}

.admin-info-header {
    background: #e7f3ff !important;
    border-bottom: 1px solid #17a2b8 !important;
}

.admin-info-body {
    background: white !important;
}

.admin-info-text {
    margin-bottom: 0.5rem !important;
    font-size: 0.9rem !important;
}

.admin-form-label {
    color: #495057 !important;
    font-weight: 600 !important;
    margin-bottom: 0.5rem !important;
}

.admin-form-select,
.admin-form-textarea {
    border: 2px solid #e9ecef !important;
    border-radius: 6px !important;
    padding: 0.75rem !important;
    transition: all 0.3s ease !important;
}

.admin-form-select:focus,
.admin-form-textarea:focus {
    border-color: #007bff !important;
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25) !important;
    outline: none !important;
}

.admin-status-preview {
    min-height: 42px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: white !important;
    border: 2px solid #e9ecef !important;
}

.admin-warning-alert {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7) !important;
    border: 1px solid #ffc107 !important;
    border-radius: 6px !important;
    color: #856404 !important;
}

.admin-modal-footer {
    background: white !important;
    border-top: 1px solid #e9ecef !important;
    border-bottom-left-radius: 12px !important;
    border-bottom-right-radius: 12px !important;
    padding: 1rem 1.5rem !important;
}

.admin-btn-cancel,
.admin-btn-save {
    padding: 0.6rem 1.5rem !important;
    border-radius: 6px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.admin-btn-save {
    background: linear-gradient(135deg, #007bff, #0056b3) !important;
    border: none !important;
}

.admin-btn-save:hover {
    background: linear-gradient(135deg, #0056b3, #004085) !important;
    transform: translateY(-1px) !important;
}

.admin-btn-cancel:hover {
    background: #6c757d !important;
    transform: translateY(-1px) !important;
}

/* SYNC BUTTON STYLES */
.sync-btn {
    transition: all 0.3s ease !important;
}

.sync-btn:disabled {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
}

/* LOADING ANIMATION */
.admin-loading {
    animation: adminSpin 1s linear infinite !important;
}

@keyframes adminSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* RESPONSIVE MODAL */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem !important;
        max-width: calc(100% - 1rem) !important;
    }

    .admin-modal-body {
        padding: 1rem !important;
    }

    .admin-modal-footer {
        padding: 0.75rem 1rem !important;
    }
}

/* MODAL Z-INDEX FIX */
.modal.show {
    z-index: 1060 !important;
}

.modal-backdrop.show {
    z-index: 1055 !important;
}

/* SYNC MODAL STYLES */
#syncConfirmModal .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

#syncConfirmModal .modal-header {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    border-bottom: none;
}

#syncConfirmModal .modal-footer {
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    border-top: 1px solid #e9ecef;
}

#confirmSyncBtn {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border: none;
    transition: all 0.3s ease;
}

#confirmSyncBtn:hover {
    background: linear-gradient(135deg, #138496, #117a8b);
    transform: translateY(-1px);
}
</style>

<!-- JAVASCRIPT - SAMA DENGAN INDEX -->
<script>
// ADMIN MODAL MANAGER
class AdminModalManager {
    constructor() {
        this.modal = null;
        this.form = null;
        this.statusSelect = null;
        this.statusPreview = null;
        this.init();
    }

    init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupModal());
        } else {
            this.setupModal();
        }
    }

    setupModal() {
        // Get modal elements
        const modalElement = document.getElementById('editStatusModal');
        if (!modalElement) return;

        this.modal = new bootstrap.Modal(modalElement, {
            backdrop: 'static',
            keyboard: false
        });

        this.form = document.getElementById('editStatusForm');
        this.statusSelect = document.getElementById('adminStatusSelect');
        this.statusPreview = document.getElementById('adminStatusPreview');

        if (!this.form || !this.statusSelect || !this.statusPreview) return;

        this.attachEventListeners();
    }

    attachEventListeners() {
        // Edit button handlers
        document.querySelectorAll('.edit-status-btn').forEach(button => {
            button.addEventListener('click', (e) => this.handleEditClick(e));
        });

        // Status select change
        this.statusSelect.addEventListener('change', () => this.updateStatusPreview());

        // Form submit
        this.form.addEventListener('submit', (e) => this.handleFormSubmit(e));

        // Modal reset
        document.getElementById('editStatusModal').addEventListener('hidden.bs.modal', () => this.resetModal());

        // Sync button handlers
        document.querySelectorAll('.sync-btn').forEach(button => {
            button.addEventListener('click', (e) => this.handleSyncClick(e));
        });
    }

    handleEditClick(event) {
        const button = event.currentTarget;

        // Get data from button
        const transaksiId = button.dataset.transaksiId;
        const orderId = button.dataset.orderId;
        const customer = button.dataset.customer;
        const email = button.dataset.email;
        const jumlah = parseInt(button.dataset.jumlah);
        const kursus = button.dataset.kursus;
        const status = button.dataset.status;
        const catatan = button.dataset.catatan || '';

        // Set form action
        this.form.action = `/admin/transaksi/${transaksiId}/update-status`;

        // Fill modal with data
        document.getElementById('adminModalOrderId').textContent = orderId;
        document.getElementById('adminModalCustomer').textContent = customer;
        document.getElementById('adminModalEmail').textContent = email;
        document.getElementById('adminModalKursus').textContent = kursus;
        document.getElementById('adminModalJumlah').textContent = 'Rp ' + jumlah.toLocaleString('id-ID');
        document.getElementById('adminModalCatatan').value = catatan;

        // Set current status badge
        let statusBadge = this.getStatusBadge(status);
        document.getElementById('adminModalCurrentStatus').innerHTML = statusBadge;

        // Set select value
        this.statusSelect.value = status;
        this.updateStatusPreview();

        // Show modal
        this.modal.show();
    }

    getStatusBadge(status) {
        switch(status) {
            case 'success':
            case 'capture':
                return '<span class="badge bg-success">Lunas</span>';
            case 'pending':
                return '<span class="badge bg-warning">Pending</span>';
            case 'expired':
                return '<span class="badge bg-secondary">Expired</span>';
            case 'failed':
                return '<span class="badge bg-danger">Failed</span>';
            default:
                return '<span class="badge bg-dark">' + status.charAt(0).toUpperCase() + status.slice(1) + '</span>';
        }
    }

    updateStatusPreview() {
        const selectedValue = this.statusSelect.value;
        let preview = '<span class="text-muted">Pilih status</span>';

        if (selectedValue) {
            preview = this.getStatusBadge(selectedValue);
        }

        this.statusPreview.innerHTML = preview;
    }

    handleFormSubmit(event) {
        if (!this.statusSelect.value) {
            event.preventDefault();
            alert('Silakan pilih status pembayaran!');
            this.statusSelect.focus();
            return;
        }

        // const selectedText = this.statusSelect.options[this.statusSelect.selectedIndex].text;
        // if (!confirm(`Yakin mengubah status menjadi "${selectedText}"?`)) {
        //     event.preventDefault();
        //     return;
        // }

        // Show loading state
        const submitBtn = document.getElementById('adminBtnSaveStatus');
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split admin-loading"></i> Menyimpan...';
        submitBtn.disabled = true;
    }

    handleSyncClick(event) {
        const button = event.currentTarget;
        const form = button.closest('form');
        const orderId = button.dataset.orderId;

        // Get customer name from the page data (show page context)
        let customerName = '-';

        // Try to get from the user info section
        const userNameElement = document.querySelector('h6.text-primary');
        if (userNameElement && userNameElement.previousElementSibling) {
            // Look for customer name in the user information section
            const userInfoTable = document.querySelector('.card-body table');
            if (userInfoTable) {
                const nameRow = Array.from(userInfoTable.querySelectorAll('tr')).find(row =>
                    row.querySelector('td') && row.querySelector('td').textContent.includes('Nama Lengkap:')
                );
                if (nameRow) {
                    const nameCell = nameRow.querySelector('td:nth-child(2)');
                    if (nameCell) {
                        customerName = nameCell.textContent.trim();
                    }
                }
            }
        }

        // If still not found, try to get from the global transaksi data
        if (customerName === '-') {
            // Try to get from any element that contains user name
            const nameElements = document.querySelectorAll('td, p, span');
            for (let element of nameElements) {
                if (element.textContent.includes('{{ $transaksi->user->nama_lengkap }}')) {
                    customerName = element.textContent.trim();
                    break;
                }
            }
        }

        // As fallback, use a generic description
        if (customerName === '-') {
            customerName = 'Transaksi ID: ' + orderId;
        }

        // Fill modal with data
        document.getElementById('syncOrderId').textContent = orderId;
        document.getElementById('syncCustomer').textContent = customerName;

        // Show sync confirmation modal
        const syncModal = new bootstrap.Modal(document.getElementById('syncConfirmModal'));
        syncModal.show();

        // Store form reference for later submission
        const confirmSyncBtn = document.getElementById('confirmSyncBtn');
        confirmSyncBtn.onclick = () => {
            // Show loading state on original button
            button.innerHTML = '<i class="bi bi-arrow-clockwise admin-loading"></i> Sinkronisasi...';
            button.disabled = true;

            // Hide modal
            syncModal.hide();

            // Submit form
            form.submit();
        }
    }

    resetModal() {
        this.form.reset();
        this.statusPreview.innerHTML = '<span class="text-muted">Pilih status</span>';

        // Reset submit button
        const submitBtn = document.getElementById('adminBtnSaveStatus');
        submitBtn.innerHTML = '<i class="bi bi-check"></i> Update Status';
        submitBtn.disabled = false;

        // Clear info fields
        document.getElementById('adminModalOrderId').textContent = '-';
        document.getElementById('adminModalCustomer').textContent = '-';
        document.getElementById('adminModalEmail').textContent = '-';
        document.getElementById('adminModalKursus').textContent = '-';
        document.getElementById('adminModalJumlah').textContent = '-';
        document.getElementById('adminModalCurrentStatus').innerHTML = '-';
    }
}

// Initialize Admin Modal Manager
const adminModalManager = new AdminModalManager();

// Auto hide alerts
setTimeout(() => {
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        try {
            const alertInstance = new bootstrap.Alert(alert);
            alertInstance.close();
        } catch (e) {
            console.warn('Could not close alert:', e);
        }
    });
}, 5000);

// Add tooltips
try {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
} catch (e) {
    console.warn('Could not initialize tooltips:', e);
}
</script>
