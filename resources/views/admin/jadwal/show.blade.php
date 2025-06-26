<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-info-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Detail lengkap jadwal kursus dan daftar peserta yang terdaftar.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Jadwal
                </a>
                <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Jadwal
                </a>
            </div>
        </div>

        <!-- Jadwal Detail -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-calendar3"></i> Informasi Jadwal</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="text-primary">{{ $jadwal->kursus->nama_kursus }} - {{ $jadwal->hari }}</h4>
                        <p class="text-muted">{{ $jadwal->kursus->deskripsi }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Kursus:</strong></td>
                                        <td>{{ $jadwal->kursus->nama_kursus }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Instruktur:</strong></td>
                                        <td>{{ $jadwal->instruktur->nama_instruktur }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pengalaman:</strong></td>
                                        <td>{{ $jadwal->instruktur->pengalaman }} tahun</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Hari:</strong></td>
                                        <td><span class="badge bg-primary">{{ $jadwal->hari }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Jam Mulai:</strong></td>
                                        <td>{{ $jadwal->jam_mulai->format('H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jam Selesai:</strong></td>
                                        <td>{{ $jadwal->jam_selesai->format('H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $jadwal->jam_mulai->diffInMinutes($jadwal->jam_selesai) }} menit</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $jadwal->status === 'aktif' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($jadwal->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Kapasitas Maksimal:</strong></td>
                                        <td><span class="badge bg-warning">{{ $jadwal->kapasitas_maksimal }} orang</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Peserta:</strong></td>
                                        <td><span class="badge bg-primary">{{ $pesertas->count() }} orang</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kapasitas Tersisa:</strong></td>
                                        <td><span class="badge bg-success">{{ $jadwal->kapasitasTersedia() }} orang</span></td>
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

                        <!-- Progress Bar -->
                        <div class="mt-3">
                            <small class="text-muted">Kapasitas Terisi</small>
                            <div class="progress">
                                @php
                                    $persentase = $jadwal->kapasitas_maksimal > 0 ? ($pesertas->where('status', 'aktif')->count() / $jadwal->kapasitas_maksimal) * 100 : 0;
                                @endphp
                                <div class="progress-bar" role="progressbar" style="width: {{ $persentase }}%">
                                    {{ round($persentase) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Kursus -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-water"></i> Info Kursus</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Biaya:</strong> Rp {{ number_format($jadwal->kursus->biaya, 0, ',', '.') }}</p>
                        <p><strong>Durasi Kursus:</strong> {{ $jadwal->kursus->durasi }}</p>
                        <p><strong>Periode:</strong><br>
                           {{ $jadwal->kursus->tanggal_mulai->format('d M Y') }} - 
                           {{ $jadwal->kursus->tanggal_selesai->format('d M Y') }}
                        </p>
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
                                            <th>Aksi</th>
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
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-info btn-sm" title="Detail Peserta">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        @if($peserta->status === 'aktif')
                                                            <button class="btn btn-warning btn-sm" title="Ubah Status">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        @endif
                                                    </div>
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
                                <p class="text-muted">Jadwal ini belum memiliki peserta yang mendaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>