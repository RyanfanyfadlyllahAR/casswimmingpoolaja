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
                        <h4 class="mt-2">{{ $totalKursus ?? 5 }}</h4>
                        <small>Kursus Tersedia</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">{{ $totalTransaksi ?? 0 }}</h4>
                        <small>Total Transaksi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-currency-dollar" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h4>
                        <small>Total Pendapatan</small>
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
                                <a href="{{ route('admin.jadwal') }}" class="btn btn-outline-info btn-lg w-100">
                                    <i class="bi bi-calendar3 d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Jadwal
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.instruktur') }}" class="btn btn-outline-warning btn-lg w-100">
                                    <i class="bi bi-person-check d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Instruktur
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-dark btn-lg w-100">
                                    <i class="bi bi-credit-card d-block mb-2" style="font-size: 2rem;"></i>
                                    Kelola Transaksi
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="#" class="btn btn-outline-secondary btn-lg w-100">
                                    <i class="bi bi-bar-chart d-block mb-2" style="font-size: 2rem;"></i>
                                    Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-activity"></i> Transaksi Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($transaksiTerbaru) && $transaksiTerbaru->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($transaksiTerbaru as $transaksi)
                                    <div class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $transaksi->user->nama_lengkap }}</div>
                                            <small>{{ $transaksi->kursus->nama_kursus }}</small><br>
                                            <small class="text-success">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</small>
                                        </div>
                                        <div class="text-end">
                                            @if($transaksi->status_pembayaran == 'settlement' || $transaksi->status_pembayaran == 'capture')
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif($transaksi->status_pembayaran == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                            @endif
                                            <br><small>{{ $transaksi->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-primary">
                                    Lihat Semua Transaksi
                                </a>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="bi bi-receipt text-muted" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2">Belum ada transaksi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>