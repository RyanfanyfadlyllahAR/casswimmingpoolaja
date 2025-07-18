<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-people"></i> {{ $title }}</h1>
                            <p class="mb-0">Kelola data peserta kursus renang dan status pendaftaran mereka.</p>
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
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-warning">
                    <i class="bi bi-credit-card"></i> Kelola Transaksi
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
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Peserta Aktif</h6>
                                <h4>{{ $pesertas->where('status', 'aktif')->count() }}</h4>
                            </div>
                            <i class="bi bi-person-check" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Peserta Non-Aktif</h6>
                                <h4>{{ $pesertas->where('status', 'nonaktif')->count() }}</h4>
                            </div>
                            <i class="bi bi-clock" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6>Selesai</h6>
                                <h4>{{ $pesertas->where('status', 'selesai')->count() }}</h4>
                            </div>
                            <i class="bi bi-trophy" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('peserta.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau kursus..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Peserta Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Peserta ({{ $pesertas->count() }} orang)</h5>

                    </div>
                    <div class="card-body">
                        @if($pesertas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Peserta</th>
                                            <th>Kursus</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th>Pembayaran</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesertas as $index => $peserta)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                        <div>
                                                            <strong>{{ $peserta->user->nama_lengkap }}</strong><br>
                                                            <small class="text-muted">{{ $peserta->user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>{{ $peserta->kursus->nama_kursus }}</strong><br>
                                                    <small class="text-muted">{{ $peserta->kursus->durasi }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $peserta->jadwal->hari }}</span><br>
                                                    <small>{{ $peserta->jadwal->jam_mulai->format('H:i') }}-{{ $peserta->jadwal->jam_selesai->format('H:i') }}</small><br>
                                                    <small class="text-muted">{{ $peserta->jadwal->instruktur->nama_instruktur }}</small>
                                                </td>
                                                <td>
                                                    @if($peserta->status == 'aktif')
                                                        <span class="badge bg-success">Aktif</span>
                                                    @elseif($peserta->status == 'nonaktif')
                                                        <span class="badge bg-danger">Non-Aktif</span>
                                                    @elseif($peserta->status == 'selesai')
                                                        <span class="badge bg-primary">Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">Batal</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($peserta->status_pembayaran == 'lunas')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($peserta->status_pembayaran == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Failed</span>
                                                    @endif
                                                </td>
                                                <td>{{ $peserta->tanggal_daftar->format('d M Y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('peserta.show', $peserta) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('peserta.edit', $peserta) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-danger" onclick="deletePeserta({{ $peserta->id }}, '{{ $peserta->user->nama_lengkap }}')" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-person-x text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3">Belum Ada Peserta</h5>
                                <p class="text-muted">Tidak ada peserta yang terdaftar saat ini.</p>
                                <a href="{{ route('peserta.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Peserta Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus peserta <strong id="pesertaName"></strong>?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deletePeserta(id, nama) {
            document.getElementById('pesertaName').textContent = nama;
            document.getElementById('deleteForm').action = '/peserta/' + id;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-layout>
