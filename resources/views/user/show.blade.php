<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2"><i class="bi bi-person-circle"></i> {{ $title }}</h1>
                            <p class="mb-0">Detail lengkap informasi user dan riwayat kursus.</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-{{ $user->is_admin ? 'danger' : 'success' }} fs-6">
                                {{ $user->is_admin ? 'ADMIN' : 'USER' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Peserta
                </a>
                @if($user->pesertas->count() > 0)
                    <a href="{{ route('peserta.show', $user->pesertas->first()) }}" class="btn btn-info">
                        <i class="bi bi-person-badge"></i> Lihat sebagai Peserta
                    </a>
                @endif
            </div>
        </div>

        <!-- Detail User -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Info User -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Informasi User</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Username:</strong></td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Lengkap:</strong></td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin:</strong></td>
                                        <td>{{ $user->jenis_kelamin }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Tempat, Tanggal Lahir:</strong></td>
                                        <td>{{ $user->tempat_lahir }}, {{ $user->tanggal_lahir->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Telepon:</strong></td>
                                        <td>{{ $user->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Asal Sekolah:</strong></td>
                                        <td>{{ $user->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Member Since:</strong></td>
                                        <td>{{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong>Alamat:</strong>
                                <p class="mt-1">{{ $user->alamat }}</p>
                            </div>
                        </div>

                        @if($user->foto_kk)
                            <div class="row mt-3">
                                <div class="col-12">
                                    <strong>Foto Kartu Keluarga:</strong>
                                    <div class="mt-2">
                                        <a href="{{ Storage::url($user->foto_kk) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i> Lihat Foto KK
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Kursus -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-water"></i> Riwayat Kursus</h5>
                    </div>
                    <div class="card-body">
                        @if($user->pesertas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kursus</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->pesertas as $peserta)
                                            <tr>
                                                <td>
                                                    <strong>{{ $peserta->kursus->nama_kursus }}</strong><br>
                                                    <small class="text-muted">{{ $peserta->kursus->durasi }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $peserta->jadwal->hari }}</span><br>
                                                    <small>{{ $peserta->jadwal->jam_mulai->format('H:i') }}-{{ $peserta->jadwal->jam_selesai->format('H:i') }}</small>
                                                </td>
                                                <td>
                                                    @if($peserta->status == 'aktif')
                                                        <span class="badge bg-success">Aktif</span>
                                                    @elseif($peserta->status == 'nonaktif')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($peserta->status == 'selesai')
                                                        <span class="badge bg-primary">Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">Batal</span>
                                                    @endif
                                                </td>
                                                <td>{{ $peserta->tanggal_daftar->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('peserta.show', $peserta) }}" class="btn btn-sm btn-outline-info">
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
                                <i class="bi bi-water text-muted" style="font-size: 3rem;"></i>
                                <h6 class="mt-3">Belum Ada Kursus</h6>
                                <p class="text-muted">User ini belum pernah mendaftar kursus.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Statistik User -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-bar-chart"></i> Statistik</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="bg-primary text-white rounded p-3">
                                    <h4>{{ $user->pesertas->count() }}</h4>
                                    <small>Total Kursus</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="bg-success text-white rounded p-3">
                                    <h4>{{ $user->pesertas->where('status', 'aktif')->count() }}</h4>
                                    <small>Kursus Aktif</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-warning text-dark rounded p-3">
                                    <h4>{{ $user->pesertas->where('status', 'selesai')->count() }}</h4>
                                    <small>Selesai</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-info text-white rounded p-3">
                                    <h4>{{ $user->created_at->diffInDays(now()) }}</h4>
                                    <small>Hari Bergabung</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-lightning"></i> Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            @if($user->pesertas->count() > 0)
                                <a href="{{ route('peserta.show', $user->pesertas->first()) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-badge"></i> Lihat sebagai Peserta
                                </a>
                            @endif
                            <a href="{{ route('peserta.create') }}" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-plus-circle"></i> Daftarkan ke Kursus
                            </a>
                            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-credit-card"></i> Lihat Transaksi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Foto KK Preview -->
                @if($user->foto_kk)
                    <div class="card shadow mt-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-image"></i> Foto Kartu Keluarga</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ Storage::url($user->foto_kk) }}" alt="Foto KK" 
                                 class="img-thumbnail" style="max-height: 200px;">
                            <div class="mt-2">
                                <a href="{{ Storage::url($user->foto_kk) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Lihat Full Size
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>