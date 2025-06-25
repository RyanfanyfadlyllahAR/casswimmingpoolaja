<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-water"></i> Daftar Kursus Renang</h1>
                    <p class="mb-0">Pilih kursus renang yang sesuai dengan kebutuhan dan tingkat kemampuan Anda.</p>
                </div>
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

        <!-- Daftar Kursus -->
        <div class="row">
            @forelse($kursus as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">{{ $item->nama_kursus }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> <strong>Durasi:</strong> {{ $item->durasi }}<br>
                                    <i class="bi bi-calendar3"></i> <strong>Mulai:</strong> {{ $item->tanggal_mulai->format('d M Y') }}<br>
                                    <i class="bi bi-calendar-check"></i> <strong>Selesai:</strong> {{ $item->tanggal_selesai->format('d M Y') }}<br>
                                    <i class="bi bi-currency-dollar"></i> <strong>Biaya:</strong> Rp {{ number_format($item->biaya, 0, ',', '.') }}
                                </small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                <small class="text-muted">{{ $item->pesertas->count() }} peserta</small>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-grid gap-2">
                                <a href="{{ route('kursus.show', $item) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle"></i> Belum ada kursus yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Back to Dashboard -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="/dashboard" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-layout>