<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-danger text-white text-center">
                        <h4 class="mb-0"><i class="bi bi-x-circle"></i> Error Pembayaran</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h5>Terjadi Kesalahan Saat Pembayaran</h5>
                        <p class="text-muted">Maaf, terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi.</p>
                        
                        <div class="alert alert-danger">
                            <h6><i class="bi bi-exclamation-triangle"></i> Kemungkinan Penyebab:</h6>
                            <ul class="list-unstyled mb-0">
                                <li>• Koneksi internet tidak stabil</li>
                                <li>• Timeout saat pembayaran</li>
                                <li>• Kesalahan pada sistem pembayaran</li>
                                <li>• Data pembayaran tidak valid</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('kursus.index') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-clockwise"></i> Coba Lagi
                            </a>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-list"></i> Riwayat Transaksi
                            </a>
                            <a href="/kontak" class="btn btn-outline-danger">
                                <i class="bi bi-telephone"></i> Hubungi CS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>