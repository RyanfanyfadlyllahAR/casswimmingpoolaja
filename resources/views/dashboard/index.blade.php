<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo CSP" class="rounded-circle" width="80">
                        <h6 class="mt-2">{{ Auth::user()->nama_lengkap }}</h6>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">
                                <i class="bi bi-house-door"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profil" onclick="scrollToSection('profil')">
                                <i class="bi bi-person"></i>
                                Profil Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kursus.ku') }}">
                                <i class="bi bi-water"></i>
                                Kursus Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal" onclick="scrollToSection('jadwal')">
                                <i class="bi bi-calendar3"></i>
                                Jadwal Latihan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksi.index') }}">
                                <i class="bi bi-credit-card"></i>
                                Pembayaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sertifikat" onclick="scrollToSection('sertifikat')">
                                <i class="bi bi-award"></i>
                                Sertifikat
                            </a>
                        </li>
                    </ul>

                    <hr>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="bi bi-house"></i>
                                Kembali ke Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100 border-0">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <small class="text-muted">
                            Login terakhir: {{ Auth::user()->updated_at->format('d M Y, H:i') }}
                        </small>
                    </div>
                </div>

                <!-- Welcome Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>
                                <strong>Selamat datang, {{ Auth::user()->nama_lengkap }}!</strong>
                                <br>Selamat datang di Dashboard CAS Swimming Pool. Kelola profil dan pantau progress kursus renang Anda di sini.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                @php
                    $userPesertas = Auth::user()->pesertas ?? collect();
                    $totalKursus = $userPesertas->count();
                    $kursusSelesai = $userPesertas->where('status', 'selesai')->count();
                    $kursusAktif = $userPesertas->where('status', 'aktif')->count();
                    $totalSertifikat = $kursusSelesai; // Asumsi 1 sertifikat per kursus selesai
                @endphp
                
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Kursus
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKursus }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-water text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Kursus Selesai
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kursusSelesai }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Kursus Aktif
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kursusAktif }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-clock text-info" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Sertifikat
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSertifikat }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-award text-warning" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Summary -->
                <div class="row mb-4" id="profil">
                    <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Profil</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Username:</strong></td>
                                                <td>{{ Auth::user()->username }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nama Lengkap:</strong></td>
                                                <td>{{ Auth::user()->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jenis Kelamin:</strong></td>
                                                <td>{{ Auth::user()->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tempat, Tanggal Lahir:</strong></td>
                                                <td>{{ Auth::user()->tempat_lahir }}, {{ Auth::user()->tanggal_lahir->format('d M Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>No. Telepon:</strong></td>
                                                <td>{{ Auth::user()->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Asal Sekolah:</strong></td>
                                                <td>{{ Auth::user()->asal_sekolah }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Alamat:</strong></td>
                                                <td>{{ Str::limit(Auth::user()->alamat, 50) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('user.edit-profile') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Edit Profil
                                    </a>
                                    <a href="{{ route('user.edit-password') }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-key"></i> Ganti Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    @if($userPesertas->count() > 0)
                                        @foreach($userPesertas->take(3) as $peserta)
                                            <div class="timeline-item">
                                                <div class="timeline-marker bg-{{ $peserta->status == 'aktif' ? 'success' : ($peserta->status == 'selesai' ? 'primary' : 'warning') }}"></div>
                                                <div class="timeline-content">
                                                    <small class="text-muted">{{ $peserta->created_at->diffForHumans() }}</small>
                                                    <p class="mb-0">{{ $peserta->status == 'aktif' ? 'Sedang mengikuti' : ($peserta->status == 'selesai' ? 'Menyelesaikan' : 'Mendaftar') }} {{ $peserta->kursus->nama_kursus ?? 'kursus' }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-info"></div>
                                            <div class="timeline-content">
                                                <small class="text-muted">{{ Auth::user()->created_at->diffForHumans() }}</small>
                                                <p class="mb-0">Akun berhasil dibuat</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Latihan -->
                <div class="row mb-4" id="jadwal">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Latihan Aktif</h6>
                            </div>
                            <div class="card-body">
                                @if($userPesertas->where('status', 'aktif')->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Kursus</th>
                                                    <th>Hari</th>
                                                    <th>Waktu</th>
                                                    <th>Instruktur</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($userPesertas->where('status', 'aktif') as $peserta)
                                                    <tr>
                                                        <td>{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</td>
                                                        <td>{{ $peserta->jadwal->hari ?? 'N/A' }}</td>
                                                        <td>
                                                            @if($peserta->jadwal)
                                                                {{ $peserta->jadwal->jam_mulai->format('H:i') }} - {{ $peserta->jadwal->jam_selesai->format('H:i') }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $peserta->jadwal->instruktur->nama_instruktur ?? 'N/A' }}</td>
                                                        <td><span class="badge bg-success">Aktif</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                        <h6 class="mt-3">Tidak Ada Jadwal Aktif</h6>
                                        <p class="text-muted">Anda belum memiliki jadwal latihan yang aktif.</p>
                                        <a href="{{ route('kursus.index') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Daftar Kursus
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikat -->
                <div class="row mb-4" id="sertifikat">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sertifikat Saya</h6>
                            </div>
                            <div class="card-body">
                                @if($userPesertas->where('status', 'selesai')->count() > 0)
                                    <div class="row">
                                        @foreach($userPesertas->where('status', 'selesai') as $peserta)
                                            <div class="col-md-6 col-lg-4 mb-3">
                                                <div class="card border-warning">
                                                    <div class="card-body text-center">
                                                        <i class="bi bi-award text-warning" style="font-size: 3rem;"></i>
                                                        <h6 class="mt-2">{{ $peserta->kursus->nama_kursus ?? 'N/A' }}</h6>
                                                        <small class="text-muted">Selesai: {{ $peserta->updated_at->format('d M Y') }}</small>
                                                        <div class="mt-2">
                                                            <button class="btn btn-outline-warning btn-sm" onclick="generateCertificate('{{ $peserta->id }}')">
                                                                <i class="bi bi-download"></i> Download
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="bi bi-award text-muted" style="font-size: 3rem;"></i>
                                        <h6 class="mt-3">Belum Ada Sertifikat</h6>
                                        <p class="text-muted">Selesaikan kursus untuk mendapatkan sertifikat.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Menu Cepat</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="{{ route('kursus.index') }}" class="btn btn-outline-primary btn-lg w-100">
                                            <i class="bi bi-calendar-plus d-block mb-2" style="font-size: 2rem;"></i>
                                            Daftar Kursus Baru
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="{{ route('kursus.ku') }}" class="btn btn-outline-success btn-lg w-100">
                                            <i class="bi bi-calendar-check d-block mb-2" style="font-size: 2rem;"></i>
                                            Lihat Kursus Saya
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-info btn-lg w-100">
                                            <i class="bi bi-credit-card d-block mb-2" style="font-size: 2rem;"></i>
                                            Riwayat Pembayaran
                                        </a>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <button class="btn btn-outline-warning btn-lg w-100" onclick="scrollToSection('sertifikat')">
                                            <i class="bi bi-download d-block mb-2" style="font-size: 2rem;"></i>
                                            Download Sertifikat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <style>
        .sidebar {
            min-height: calc(100vh - 120px);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }
        
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e3e6f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -24px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .timeline-content {
            padding-left: 10px;
        }

        .nav-link {
            color: #858796;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: #5a5c69;
            background-color: #eaecf4;
            border-radius: 0.35rem;
        }

        .card {
            border: 1px solid #e3e6f0;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        function generateCertificate(pesertaId) {
            // Placeholder untuk generate sertifikat
            alert('Fitur download sertifikat akan segera tersedia!\nPeserta ID: ' + pesertaId);
            // Implementasi future: window.open('/sertifikat/download/' + pesertaId);
        }
    </script>
</x-layout>