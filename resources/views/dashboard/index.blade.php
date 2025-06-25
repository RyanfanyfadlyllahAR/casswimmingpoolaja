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
                            <a class="nav-link active" aria-current="page" href="/dashboard">
                                <i class="bi bi-house-door"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profil">
                                <i class="bi bi-person"></i>
                                Profil Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kursus">
                                <i class="bi bi-water"></i>
                                Kursus Saya
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#jadwal">
                                <i class="bi bi-calendar3"></i>
                                Jadwal Latihan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pembayaran">
                                <i class="bi bi-credit-card"></i>
                                Pembayaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sertifikat">
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
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Kursus
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                <div class="row mb-4">
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
                                                <td>{{ Auth::user()->alamat }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Edit Profil
                                    </button>
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
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <small class="text-muted">2 hari yang lalu</small>
                                            <p class="mb-0">Menyelesaikan latihan gaya bebas</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success"></div>
                                        <div class="timeline-content">
                                            <small class="text-muted">1 minggu yang lalu</small>
                                            <p class="mb-0">Mendaftar kursus tingkat menengah</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <small class="text-muted">2 minggu yang lalu</small>
                                            <p class="mb-0">Akun berhasil dibuat</p>
                                        </div>
                                    </div>
                                </div>
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
                                        <button class="btn btn-outline-primary btn-lg w-100">
                                            <i class="bi bi-calendar-plus d-block mb-2" style="font-size: 2rem;"></i>
                                            Daftar Kursus Baru
                                        </button>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <button class="btn btn-outline-success btn-lg w-100">
                                            <i class="bi bi-calendar-check d-block mb-2" style="font-size: 2rem;"></i>
                                            Lihat Jadwal
                                        </button>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <button class="btn btn-outline-info btn-lg w-100">
                                            <i class="bi bi-credit-card d-block mb-2" style="font-size: 2rem;"></i>
                                            Riwayat Pembayaran
                                        </button>
                                    </div>
                                    <div class="col-md-3 text-center mb-3">
                                        <button class="btn btn-outline-warning btn-lg w-100">
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
    </style>
</x-layout>