<x-layout>
    <x-slot:title>Pembayaran Kursus</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-credit-card"></i> Pembayaran Kursus</h5>
                    </div>
                    <div class="card-body">
                        <!-- Detail Pesanan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Detail Kursus:</h6>
                                <p class="mb-1"><strong>{{ $kursus->nama_kursus }}</strong></p>
                                <p class="text-muted mb-1">{{ $kursus->durasi }}</p>
                                <p class="text-muted">{{ $jadwal->hari }}, {{ $jadwal->jam_mulai->format('H:i') }}-{{ $jadwal->jam_selesai->format('H:i') }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h6>Detail Pembayaran:</h6>
                                <p class="mb-1">Order ID: <code>{{ $transaksi->order_id }}</code></p>
                                <p class="mb-1"><strong class="text-primary">Total: Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</strong></p>
                            </div>
                        </div>

                        <!-- Tombol Bayar -->
                        <div class="text-center">
                            <button id="pay-button" class="btn btn-primary btn-lg">
                                <i class="bi bi-credit-card"></i> Bayar Sekarang
                            </button>
                            <p class="text-muted mt-2">
                                <small>Anda akan diarahkan ke halaman pembayaran yang aman</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = '{{ route("transaksi.finish") }}?order_id={{ $transaksi->order_id }}';
                },
                onPending: function(result){
                    window.location.href = '{{ route("transaksi.unfinish") }}?order_id={{ $transaksi->order_id }}';
                },
                onError: function(result){
                    window.location.href = '{{ route("transaksi.error") }}?order_id={{ $transaksi->order_id }}';
                }
            });
        };
    </script>
</x-layout>