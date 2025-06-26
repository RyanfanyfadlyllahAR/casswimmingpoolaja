<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-person-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Detail lengkap instruktur dan jadwal mengajar.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.instruktur') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Instruktur
                </a>
                <a href="{{ route('admin.instruktur.edit', $instruktur) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Instruktur
                </a>
            </div>
        </div>

        <!-- Detail Instruktur -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Informasi Instruktur</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                    <i class="bi bi-person" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="mt-3">{{ $instruktur->nama_instruktur }}</h5>
                                <span class="badge bg-{{ $instruktur->status === 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($instruktur->status) }}
                                </span>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $instruktur->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Telepon:</strong></td>
                                        <td>{{ $instruktur->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pengalaman:</strong></td>
                                        <td>{{ $instruktur->pengalaman }} tahun</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sertifikat:</strong></td>
                                        <td>{{ $instruktur->sertifikat ?: 'Tidak ada' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Terdaftar:</strong></td>
                                        <td>{{ $instruktur->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                                
                                <h6><i class="bi bi-star"></i> Keahlian & Spesialisasi</h6>
                                <p class="text-muted">{{ $instruktur->keahlian }}</p>
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
                                    <h3>{{ $jadwals->count() }}</h3>
                                    <small>Total Jadwal</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-success text-white rounded p-2">
                                    <h4>{{ $jadwals->where('status', 'aktif')->count() }}</h4>
                                    <small>Jadwal Aktif</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-info text-white rounded p-2">
                                    <h4>{{ $jadwals->sum(function($jadwal) { return $jadwal->pesertas->count(); }) }}</h4>
                                    <small>Total Peserta</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal Mengajar -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-calendar3"></i> Jadwal Mengajar ({{ $jadwals->count() }} jadwal)</h5>
                    </div>
                    <div class="card-body">
                        @if($jadwals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kursus</th>
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
                                                </td>
                                                <td>{{ $jadwal->hari }}</td>
                                                <td>{{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}</td>
                                                <td>{{ $jadwal->kapasitas_maksimal }} orang</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $jadwal->pesertas->count() }} peserta</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $jadwal->status === 'aktif' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($jadwal->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.jadwal.show', $jadwal) }}" class="btn btn-info btn-sm" title="Detail Jadwal">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <h6 class="mt-3">Belum Ada Jadwal</h6>
                                <p class="text-muted">Instruktur ini belum memiliki jadwal mengajar.</p>
                                <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Tambah Jadwal
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>