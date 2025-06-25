<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Daftar Kursus</a></li>
                        <li class="breadcrumb-item active">{{ $kursus->nama_kursus }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alert -->
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

        <!-- Detail Kursus -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-water"></i> {{ $kursus->nama_kursus }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Deskripsi Kursus</h5>
                        <p class="text-muted">{{ $kursus->deskripsi }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h6><i class="bi bi-info-circle"></i> Informasi Kursus</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $kursus->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Mulai:</strong></td>
                                        <td>{{ $kursus->tanggal_mulai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Selesai:</strong></td>
                                        <td>{{ $kursus->tanggal_selesai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td><span class="badge bg-success">{{ ucfirst($kursus->status) }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-people"></i> Informasi Peserta</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Total Peserta:</strong></td>
                                        <td>{{ $kursus->pesertas->count() }} orang</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya Kursus:</strong></td>
                                        <td class="text-primary"><strong>Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Pendaftaran -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        @auth
                            @if($sudahDaftar)
                                <div class="alert alert-success text-center">
                                    <i class="bi bi-check-circle"></i><br>
                                    <strong>Anda sudah terdaftar</strong><br>
                                    di kursus ini
                                </div>
                                <div class="d-grid">
                                    <a href="{{ route('kursus.ku') }}" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> Lihat Kursus Saya
                                    </a>
                                </div>
                            @else
                                @if($kursus->status === 'aktif')
                                    <div class="text-center mb-3">
                                        <h4 class="text-primary">Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</h4>
                                        <small class="text-muted">Biaya kursus</small>
                                    </div>
                                    
                                    <form action="{{ route('kursus.daftar', $kursus) }}" method="POST">
                                        @csrf
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg" onclick="return confirm('Apakah Anda yakin ingin mendaftar kursus ini?')">
                                                <i class="bi bi-plus-circle"></i> Daftar Sekarang
                                            </button>
                                        </div>
                                    </form>
                                    
                                    <small class="text-muted d-block text-center mt-2">
                                        Dengan mendaftar, Anda menyetujui syarat dan ketentuan.
                                    </small>
                                @else
                                    <div class="alert alert-warning text-center">
                                        <i class="bi bi-exclamation-triangle"></i><br>
                                        Kursus ini sedang tidak tersedia
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle"></i><br>
                                Silakan login untuk mendaftar kursus
                            </div>
                            <div class="d-grid gap-2">
                                <a href="/masuk" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                                <a href="/daftar" class="btn btn-outline-primary">
                                    <i class="bi bi-person-plus"></i> Daftar Akun
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-star"></i> Fasilitas</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success"></i> Kolam renang standar</li>
                            <li><i class="bi bi-check text-success"></i> Pelatih bersertifikat</li>
                            <li><i class="bi bi-check text-success"></i> Peralatan latihan</li>
                            <li><i class="bi bi-check text-success"></i> Sertifikat kelulusan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>