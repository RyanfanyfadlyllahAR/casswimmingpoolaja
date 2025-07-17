<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-people"></i> {{ $title }}</h1>
                            <p class="mb-0">Kelola data instruktur renang dan pengajar.</p>
                        </div>
                        <a href="{{ route('admin.instruktur.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Instruktur
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
                <a href="{{ route('admin.jadwal') }}" class="btn btn-info">
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

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.instruktur') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, keahlian, atau no telepon..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Instruktur Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Instruktur</h5>
                    </div>
                    <div class="card-body">
                        @if($instrukturs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Instruktur</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No. Telepon</th>
                                            <th>Pengalaman</th>
                                            <th>Status</th>
                                            <th>Jadwal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instrukturs as $index => $instruktur)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $instruktur->nama_instruktur }}</strong>
                                                    <br><small class="text-muted">{{ Str::limit($instruktur->keahlian, 30) }}</small>
                                                </td>
                                                <td>{{ $instruktur->jenis_kelamin }}</td>
                                                <td>{{ $instruktur->no_telp }}</td>
                                                <td>{{ $instruktur->pengalaman }} tahun</td>
                                                <td>
                                                    <span class="badge bg-{{ $instruktur->status === 'aktif' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($instruktur->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $instruktur->Jadwal_Kursus->count() }} jadwal</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.instruktur.show', $instruktur) }}" class="btn btn-info btn-sm" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.instruktur.edit', $instruktur) }}" class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                                                onclick="confirmDelete({{ $instruktur->id }}, '{{ $instruktur->nama_instruktur }}')">
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
                                <h5 class="mt-3">Belum Ada Instruktur</h5>
                                <p class="text-muted">Mulai dengan menambahkan instruktur baru.</p>
                                <a href="{{ route('admin.instruktur.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Instruktur Pertama
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
                    <p>Apakah Anda yakin ingin menghapus instruktur <strong id="instrukturName"></strong>?</p>
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
            document.getElementById('instrukturName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/instruktur/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-layout>