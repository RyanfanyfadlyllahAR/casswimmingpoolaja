<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0"><i class="bi bi-check-circle"></i> Pembayaran Berhasil!</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        @if($transaksi)
                            <h5>Terima kasih atas pembayaran Anda!</h5>
                            <p class="text-muted">Pembayaran untuk kursus <strong>{{ $transaksi->kursus->nama_kursus }}</strong> telah berhasil diproses.</p>
                            
                            <div class="alert alert-info">
                                <h6><i class="bi bi-info-circle"></i> Informasi Selanjutnya:</h6>
                                <ul class="list-unstyled mb-0">
                                    <li>• Anda akan mendapat konfirmasi melalui email</li>
                                    <li>• Silakan datang sesuai jadwal: <strong>{{ $transaksi->jadwal->hari }}, {{ $transaksi->jadwal->jam_mulai->format('H:i') }}-{{ $transaksi->jadwal->jam_selesai->format('H:i') }}</strong></li>
                                    <li>• Instruktur: <strong>{{ $transaksi->jadwal->instruktur->nama_instruktur }}</strong></li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-primary">
                                    <i class="bi bi-receipt"></i> Lihat Detail Transaksi
                                </a>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-house"></i> Ke Dashboard
                                </a>
                            </div>
                        @else
                            <h5>Pembayaran Selesai</h5>
                            <p class="text-muted">Terima kasih atas pembayaran Anda. Silakan cek dashboard untuk informasi lebih lanjut.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="bi bi-house"></i> Ke Dashboard
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>