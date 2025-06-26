<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark text-center">
                        <h4 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Pembayaran Belum Selesai</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-clock text-warning" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h5>Pembayaran Anda Sedang Diproses</h5>
                        <p class="text-muted">Pembayaran Anda belum selesai atau sedang dalam proses verifikasi.</p>
                        
                        <div class="alert alert-warning">
                            <h6><i class="bi bi-info-circle"></i> Apa yang harus dilakukan:</h6>
                            <ul class="list-unstyled mb-0">
                                <li>• Periksa email Anda untuk instruksi pembayaran</li>
                                <li>• Selesaikan pembayaran jika belum selesai</li>
                                <li>• Tunggu konfirmasi pembayaran (maks. 24 jam)</li>
                                <li>• Hubungi customer service jika ada kendala</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-primary">
                                <i class="bi bi-list"></i> Cek Status Transaksi
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                                <i class="bi bi-house"></i> Ke Dashboard
                            </a>
                            <a href="/kontak" class="btn btn-outline-warning">
                                <i class="bi bi-telephone"></i> Hubungi CS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>