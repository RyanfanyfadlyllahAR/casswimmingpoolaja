<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-calendar3"></i> {{ $title }}</h1>
                            <p class="mb-0">Kelola jadwal kursus renang dan pembagian instruktur.</p>
                        </div>
                        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Jadwal
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
                <a href="{{ route('admin.instruktur') }}" class="btn btn-info me-2">
                    <i class="bi bi-people"></i> Kelola Instruktur
                </a>
                <a href="{{ route('admin.kursus') }}" class="btn btn-warning">
                    <i class="bi bi-water"></i> Kelola Kursus
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

        <!-- Jadwal Table -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-table"></i> Daftar Jadwal Kursus</h5>
                    </div>
                    <div class="card-body">
                        @if($jadwals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Kursus</th>
                                            <th>Instruktur</th>
                                            <th>Hari</th>
                                            <th>Jam</th>
                                            <th>Kapasitas</th>
                                            <th>Peserta</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jadwals as $index => $jadwal)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $jadwal->kursus->nama_kursus }}</strong>
                                                    <br><small class="text-muted">{{ $jadwal->kursus->durasi }}</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $jadwal->instruktur->nama_instruktur }}</strong>
                                                    <br><small class="text-muted">{{ $jadwal->instruktur->pengalaman }} tahun</small>
                                                </td>
                                                <td>{{ $jadwal->hari }}</td>
                                                <td>
                                                    {{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}
                                                </td>
                                                <td>{{ $jadwal->kapasitas_maksimal }} orang</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $jadwal->pesertas->count() }} peserta</span>
                                                    <br><small class="text-muted">{{ $jadwal->kapasitasTersedia() }} tersisa</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $jadwal->status === 'aktif' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($jadwal->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.jadwal.show', $jadwal) }}" class="btn btn-info btn-sm" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                                                onclick="confirmDelete({{ $jadwal->id }}, '{{ $jadwal->kursus->nama_kursus }} - {{ $jadwal->hari }}')">
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
                                <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3">Belum Ada Jadwal</h5>
                                <p class="text-muted">Mulai dengan menambahkan jadwal kursus baru.</p>
                                <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Jadwal Pertama
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
                    <p>Apakah Anda yakin ingin menghapus jadwal <strong id="jadwalName"></strong>?</p>
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
            document.getElementById('jadwalName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/jadwal/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</x-layout>