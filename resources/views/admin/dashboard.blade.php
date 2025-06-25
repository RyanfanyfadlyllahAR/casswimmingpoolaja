<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="container py-4">
        <!-- Admin Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-dark text-white rounded p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="h3 mb-2"><i class="bi bi-shield-check"></i> Admin Dashboard</h1>
                            <p class="mb-0">Selamat datang, {{ Auth::user()->nama_lengkap }}! Kelola sistem CAS Swimming Pool dari sini.</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo CSP" class="rounded-circle" width="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Stats -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-people" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">{{ $totalUsers }}</h4>
                        <small>Total Peserta</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-water" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">5</h4>
                        <small>Kursus Tersedia</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-person-check" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">3</h4>
                        <small>Instruktur</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar3" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">12</h4>
                        <small>Jadwal Hari Ini</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Menu -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-gear"></i> Panel Administrasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="/peserta" class="btn btn-outline-primary btn-lg w-100">
                                    <i class="bi bi-people d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Peserta
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.kursus') }}" class="btn btn-outline-success btn-lg w-100">
                                    <i class="bi bi-water d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Kursus
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-outline-info btn-lg w-100">
                                    <i class="bi bi-calendar3 d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Jadwal
                                </button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button class="btn btn-outline-warning btn-lg w-100">
                                    <i class="bi bi-person-check d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Instruktur
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-activity"></i> Aktivitas Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Peserta Baru</div>
                                    John Doe mendaftar kursus pemula
                                </div>
                                <small>2h</small>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Pembayaran</div>
                                    Jane Smith melakukan pembayaran
                                </div>
                                <small>4h</small>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Jadwal Baru</div>
                                    Ditambahkan jadwal latihan intensif
                                </div>
                                <small>1d</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>