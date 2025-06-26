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
                            <i class="bi bi-currency-dollar" style="font-size: 2rem;"></i>
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
                                                    @if($transaksi->status_pembayaran == 'settlement' || $transaksi->status_pembayaran == 'capture')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($transaksi->status_pembayaran == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                                    @endif
                                                
                                                    @if($transaksi->updated_by_admin)
                                                        <br><small class="text-info">*Diupdate admin</small>
                                                    @endif
                                                </td>
                                                <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.transaksi.show', $transaksi) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $transaksi->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('admin.transaksi.sync-status', $transaksi) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-info" onclick="return confirm('Sinkronkan status dengan Midtrans?')">
                                                                <i class="bi bi-arrow-clockwise"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Update Status -->
                                            <div class="modal fade" id="updateStatusModal{{ $transaksi->id }}" tabindex="-1">
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
                                                                        <option value="expire" {{ $transaksi->status_pembayaran == 'expire' ? 'selected' : '' }}>Expire</option>
                                                                        <option value="failed" {{ $transaksi->status_pembayaran == 'failure' ? 'selected' : '' }}>Failed</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Catatan (Opsional)</label>
                                                                    <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan admin...">{{ $transaksi->catatan_admin }}</textarea>
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
</x-layout>