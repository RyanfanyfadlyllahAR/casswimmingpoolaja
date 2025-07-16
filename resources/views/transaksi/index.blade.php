<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-credit-card"></i> {{ $title }}</h1>
                    <p class="mb-0">Lihat riwayat pembayaran dan status transaksi Anda.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
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

        <!-- Transaksi List -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-list-ul"></i> Daftar Transaksi</h5>
                    </div>
                    <div class="card-body">
                        @if($transaksis->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Kursus</th>
                                            <th>Jadwal</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaksis as $transaksi)
                                            <tr>
                                                <td>
                                                    <code>{{ $transaksi->order_id }}</code>
                                                </td>
                                                <td>
                                                    <strong>{{ $transaksi->kursus->nama_kursus }}</strong><br>
                                                    <small class="text-muted">{{ $transaksi->kursus->durasi }}</small>
                                                </td>
                                                <td>
                                                    {{ $transaksi->jadwal->hari }}<br>
                                                    <small class="text-muted">
                                                        {{ $transaksi->jadwal->jam_mulai->format('H:i') }} - 
                                                        {{ $transaksi->jadwal->jam_selesai->format('H:i') }}
                                                    </small>
                                                </td>
                                                <td>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($transaksi->status_pembayaran == 'success' || $transaksi->status_pembayaran == 'capture')
                                                        <span class="badge bg-success">Lunas</span>
                                                    @elseif($transaksi->status_pembayaran == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaksi->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </a>
                                                    @if($transaksi->status_pembayaran == 'pending')
                                                        <a href="{{ route('transaksi.check-status', $transaksi) }}" class="btn btn-sm btn-outline-info">
                                                            <i class="bi bi-arrow-clockwise"></i> Cek Status
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-receipt text-muted" style="font-size: 4rem;"></i>
                                <h5 class="mt-3">Belum Ada Transaksi</h5>
                                <p class="text-muted">Anda belum memiliki riwayat transaksi.</p>
                                <a href="{{ route('kursus.index') }}" class="btn btn-primary">
                                    <i class="bi bi-water"></i> Lihat Kursus
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>