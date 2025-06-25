<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-water"></i> {{ $title }}</h1>
                            <p class="mb-0">Kelola dan pantau semua kursus renang yang tersedia.</p>
                        </div>
                        <a href="{{ route('admin.kursus.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Kursus
                        </a>
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

        <!-- Kursus Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Kursus</h5>
                    </div>
                    <div class="card-body">
                        @if($kursus->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Kursus</th>
                                            <th>Durasi</th>
                                            <th>Biaya</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Status</th>
                                            <th>Peserta</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kursus as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $item->nama_kursus }}</strong>
                                                    <br><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                                </td>
                                                <td>{{ $item->durasi }}</td>
                                                <td>Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                                                <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $item->status === 'aktif' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $item->pesertas_count }} orang</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.kursus.show', $item) }}" class="btn btn-info btn-sm" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.kursus.edit', $item) }}" class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                                                onclick="confirmDelete({{ $item->id }}, '{{ $item->nama_kursus }}')">
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
                                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3">Belum Ada Kursus</h5>
                                <p class="text-muted">Mulai dengan menambahkan kursus baru.</p>
                                <a href="{{ route('admin.kursus.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Kursus Pertama
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
                    <p>Apakah Anda yakin ingin menghapus kursus <strong id="kursusName"></strong>?</p>
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
        function confirmDelete(id, name) {
            document.getElementById('kursusName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/kursus/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-layout>