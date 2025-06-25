<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-info-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Detail lengkap kursus dan daftar peserta yang terdaftar.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.kursus') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kursus
                </a>
                <a href="{{ route('admin.kursus.edit', $kursus) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Kursus
                </a>
            </div>
        </div>

        <!-- Kursus Detail -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-water"></i> Informasi Kursus</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="text-primary">{{ $kursus->nama_kursus }}</h4>
                        <p class="text-muted">{{ $kursus->deskripsi }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $kursus->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya:</strong></td>
                                        <td class="text-success"><strong>Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $kursus->status === 'aktif' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($kursus->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Tanggal Mulai:</strong></td>
                                        <td>{{ $kursus->tanggal_mulai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Selesai:</strong></td>
                                        <td>{{ $kursus->tanggal_selesai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Peserta:</strong></td>
                                        <td><span class="badge bg-primary">{{ $pesertas->count() }} orang</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12 mb-3">
                                <div class="bg-primary text-white rounded p-3">
                                    <h3>{{ $pesertas->where('status', 'aktif')->count() }}</h3>
                                    <small>Peserta Aktif</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-success text-white rounded p-2">
                                    <h4>{{ $pesertas->where('status', 'selesai')->count() }}</h4>
                                    <small>Selesai</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-warning text-white rounded p-2">
                                    <h4>{{ $pesertas->where('status', 'batal')->count() }}</h4>
                                    <small>Batal</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Peserta -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-people"></i> Daftar Peserta ({{ $pesertas->count() }} orang)</h5>
                    </div>
                    <div class="card-body">
                        @if($pesertas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Peserta</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesertas as $index => $peserta)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $peserta->user->nama_lengkap }}</strong>
                                                    <br><small class="text-muted">{{ $peserta->user->username }}</small>
                                                </td>
                                                <td>{{ $peserta->user->email }}</td>
                                                <td>{{ $peserta->user->no_telp }}</td>
                                                <td>{{ $peserta->tanggal_daftar->format('d M Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $peserta->status === 'aktif' ? 'success' : ($peserta->status === 'selesai' ? 'primary' : 'warning') }}">
                                                        {{ ucfirst($peserta->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-person-x text-muted" style="font-size: 3rem;"></i>
                                <h6 class="mt-3">Belum Ada Peserta</h6>
                                <p class="text-muted">Kursus ini belum memiliki peserta yang mendaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>