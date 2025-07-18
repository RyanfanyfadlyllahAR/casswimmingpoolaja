<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-credit-card"></i> {{ $title }}</h1>
                            <p class="mb-0">Kelola dan pantau semua transaksi pembayaran kursus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Dashboard Admin
                </a>
                <a href="{{ route('admin.kursus') }}" class="btn btn-info me-2">
                    <i class="bi bi-water"></i> Kelola Kursus
                </a>
                <a href="{{ route('admin.jadwal') }}" class="btn btn-warning">
                    <i class="bi bi-calendar3"></i> Kelola Jadwal
                </a>
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

        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Total Transaksi</h6>
                                <h4>{{ $transaksis->count() }}</h4>
                            </div>
                            <i class="bi bi-receipt" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Pembayaran Lunas</h6>
                                <h4>{{ $transaksis->whereIn('status_pembayaran', ['success', 'capture'])->count() }}</h4>
                            </div>
                            <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Pending</h6>
                                <h4>{{ $transaksis->where('status_pembayaran', 'pending')->count() }}</h4>
                            </div>
                            <i class="bi bi-clock" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Total Pendapatan</h6>
                                <h4>Rp {{ number_format($transaksis->whereIn('status_pembayaran', ['success', 'capture'])->sum('jumlah'), 0, ',', '.') }}</h4>
                            </div>
                            <i class="bi bi-cash" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-list-ul"></i> Daftar Transaksi</h5>
                    </div>
                    <div class="card-body">
                        @if($transaksis->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Kursus</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaksis as $transaksi)
                                            <tr>
                                                <td><code>{{ $transaksi->order_id }}</code></td>
                                                <td>
                                                    <strong>{{ $transaksi->user->nama_lengkap }}</strong><br>
                                                    <small class="text-muted">{{ $transaksi->user->email }}</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $transaksi->kursus->nama_kursus }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ $transaksi->jadwal->hari }},
                                                        {{ $transaksi->jadwal->jam_mulai->format('H:i') }}-{{ $transaksi->jadwal->jam_selesai->format('H:i') }}
                                                    </small>
                                                </td>
                                                <td>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($transaksi->status_pembayaran == 'success' || $transaksi->status_pembayaran == 'capture')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($transaksi->status_pembayaran == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($transaksi->status_pembayaran == 'expired')
                                                        <span class="badge bg-secondary">Expired</span>
                                                    @elseif($transaksi->status_pembayaran == 'failed')
                                                        <span class="badge bg-danger">Failed</span>
                                                    @else
                                                        <span class="badge bg-dark">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                                    @endif

                                                    @if($transaksi->updated_by_admin)
                                                        <br><small class="text-info">*Diupdate admin</small>
                                                    @endif
                                                </td>
                                                <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.transaksi.show', $transaksi) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-warning edit-status-btn"
                                                                title="Edit Status"
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
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-outline-info sync-btn"
                                                                    title="Sinkronkan dengan Midtrans"
                                                                    data-order-id="{{ $transaksi->order_id }}">
                                                                <i class="bi bi-arrow-clockwise"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-receipt text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3">Belum Ada Transaksi</h5>
                                <p class="text-muted">Tidak ada transaksi yang ditemukan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UPDATE STATUS -->
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
</x-layout>

<!-- CSS STYLES -->
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

/* TABLE STYLES */
.table-responsive {
    border-radius: 0.375rem !important;
}

.btn-group .btn {
    border-radius: 0.25rem !important;
    margin-right: 2px !important;
}

.btn-group .btn:last-child {
    margin-right: 0 !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,123,255,0.05) !important;
}

.btn:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
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
</style>

<!-- JAVASCRIPT -->
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

        if (confirm(`Sinkronkan status dengan Midtrans untuk Order ID: ${orderId}?\n\nProses ini akan mengambil status terbaru dari server Midtrans.`)) {
            // Show loading state
            button.innerHTML = '<i class="bi bi-arrow-clockwise admin-loading"></i>';
            button.disabled = true;

            // Submit form
            form.submit();
        } else {
            event.preventDefault();
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
