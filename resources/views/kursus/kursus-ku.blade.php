<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-person-check"></i> Kursus Saya</h1>
                    <p class="mb-0">Kelola dan pantau progress kursus renang yang Anda ikuti.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="/dashboard" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <a href="{{ route('kursus.index') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Daftar Kursus Baru
                </a>
            </div>
        </div>

        <!-- Daftar Kursus -->
        <div class="row">
            @forelse($pesertas as $peserta)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $peserta->kursus->nama_kursus }}</h6>
                            <span class="badge bg-{{ $peserta->status === 'aktif' ? 'success' : ($peserta->status === 'selesai' ? 'primary' : 'warning') }}">
                                {{ ucfirst($peserta->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($peserta->kursus->deskripsi, 80) }}</p>
                            
                            <div class="row text-center mb-3">
                                <div class="col-4">
                                    <small class="text-muted">Durasi</small>
                                    <div><strong>{{ $peserta->kursus->durasi }}</strong></div>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">Mulai</small>
                                    <div><strong>{{ $peserta->kursus->tanggal_mulai->format('d M Y') }}</strong></div>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">Daftar</small>
                                    <div><strong>{{ $peserta->tanggal_daftar->format('d M Y') }}</strong></div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('kursus.show', $peserta->kursus) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-clipboard-x text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3">Belum Ada Kursus</h5>
                            <p class="text-muted">Anda belum mendaftar di kursus manapun.</p>
                            <a href="{{ route('kursus.index') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Daftar Kursus Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>