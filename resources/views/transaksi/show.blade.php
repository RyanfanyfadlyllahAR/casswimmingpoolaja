<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-receipt"></i> {{ $title }}</h1>
                    <p class="mb-0">Detail informasi transaksi dan pembayaran.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Riwayat Transaksi
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Detail Transaksi -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Order ID:</strong></td>
                                        <td><code>{{ $transaksi->order_id }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Transaksi:</strong></td>
                                        <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Pembayaran:</strong></td>
                                        <td>
                                            @if($transaksi->status_pembayaran == 'success' || $transaksi->status_pembayaran == 'capture')
                                                <span class="badge bg-success">Lunas</span>
                                            @elseif($transaksi->status_pembayaran == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Metode Pembayaran:</strong></td>
                                        <td>{{ $transaksi->payment_type ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Jumlah Pembayaran:</strong></td>
                                        <td><strong class="text-primary">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    @if($transaksi->transaction_time)
                                    <tr>
                                        <td><strong>Waktu Pembayaran:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->transaction_time)->format('d M Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    @if($transaksi->settlement_time)
                                    <tr>
                                        <td><strong>Waktu Settlement:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->settlement_time)->format('d M Y H:i') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @if($transaksi->status_pembayaran == 'pending')
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Pembayaran Pending</strong><br>
                                Silakan selesaikan pembayaran Anda atau periksa status pembayaran.
                            </div>
                            <a href="{{ route('transaksi.check-status', $transaksi) }}" class="btn btn-warning">
                                <i class="bi bi-arrow-clockwise"></i> Cek Status Pembayaran
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Detail Kursus -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-water"></i> Detail Kursus</h6>
                    </div>
                    <div class="card-body">
                        <h5>{{ $transaksi->kursus->nama_kursus }}</h5>
                        <p class="text-muted">{{ $transaksi->kursus->deskripsi }}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Durasi:</strong> {{ $transaksi->kursus->durasi }}</p>
                                <p><strong>Biaya:</strong> Rp {{ number_format($transaksi->kursus->biaya, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Periode:</strong><br>
                                {{ $transaksi->kursus->tanggal_mulai->format('d M Y') }} - 
                                {{ $transaksi->kursus->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal & Instruktur -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-calendar3"></i> Jadwal Latihan</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Hari:</strong> {{ $transaksi->jadwal->hari }}</p>
                        <p><strong>Jam:</strong> 
                            {{ $transaksi->jadwal->jam_mulai->format('H:i') }} - 
                            {{ $transaksi->jadwal->jam_selesai->format('H:i') }}
                        </p>
                        <p><strong>Instruktur:</strong><br>
                            {{ $transaksi->jadwal->instruktur->nama_instruktur }}
                        </p>
                        <p><strong>Kapasitas:</strong> {{ $transaksi->jadwal->kapasitas_maksimal }} orang</p>
                    </div>
                </div>

                @if($transaksi->status_pembayaran == 'settlement' || $transaksi->status_pembayaran == 'capture')
                <div class="card shadow mt-3">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0"><i class="bi bi-check-circle"></i> Pembayaran Berhasil</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-success mb-0">
                            <i class="bi bi-check-circle"></i> 
                            Pembayaran Anda telah berhasil diproses. Silakan datang sesuai jadwal yang telah ditentukan.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>