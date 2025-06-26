<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-info text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-bar-chart"></i> {{ $title }}</h1>
                    <p class="mb-0">Generate dan download laporan sistem dalam format PDF.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Preview -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-people" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">{{ $stats['total_users'] }}</h4>
                        <small>Total Users</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">{{ $stats['total_peserta'] }}</h4>
                        <small>Total Peserta</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-credit-card" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">{{ $stats['total_transaksi'] }}</h4>
                        <small>Total Transaksi</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="bi bi-currency-dollar" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h4>
                        <small>Total Pendapatan</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Generate Laporan -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-pdf"></i> Generate Laporan PDF</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.laporan.generate') }}" method="POST" target="_blank">
                            @csrf
                            
                            <!-- Jenis Laporan -->
                            <div class="mb-3">
                                <label for="jenis_laporan" class="form-label">Jenis Laporan <span class="text-danger">*</span></label>
                                <select class="form-select" id="jenis_laporan" name="jenis_laporan" required>
                                    <option value="lengkap">Laporan Lengkap (Semua Data)</option>
                                    <option value="peserta">Laporan Peserta</option>
                                    <option value="transaksi">Laporan Transaksi & Pembayaran</option>
                                    <option value="kursus">Laporan Kursus</option>
                                    <option value="instruktur">Laporan Instruktur</option>
                                </select>
                                <small class="text-muted">Pilih jenis data yang ingin disertakan dalam laporan.</small>
                            </div>

                            <!-- Periode -->
                            <div class="mb-3">
                                <label for="periode" class="form-label">Periode Laporan</label>
                                <select class="form-select" id="periode" name="periode" onchange="toggleCustomDate()">
                                    <option value="hari_ini">Hari Ini</option>
                                    <option value="minggu_ini">Minggu Ini</option>
                                    <option value="bulan_ini" selected>Bulan Ini</option>
                                    <option value="tahun_ini">Tahun Ini</option>
                                    <option value="custom">Custom (Pilih Tanggal)</option>
                                </select>
                            </div>

                            <!-- Custom Date Range -->
                            <div id="custom-date-range" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-info me-md-2" onclick="previewLaporan()">
                                    <i class="bi bi-eye"></i> Preview
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-download"></i> Download PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Quick Stats Detail -->
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-info-circle"></i> Detail Statistik</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Kursus</small>
                                    <div class="fw-bold">{{ $stats['total_kursus'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Instruktur</small>
                                    <div class="fw-bold">{{ $stats['total_instruktur'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Jadwal</small>
                                    <div class="fw-bold">{{ $stats['total_jadwal'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Pending</small>
                                    <div class="fw-bold text-warning">{{ $stats['transaksi_pending'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Aktif</small>
                                    <div class="fw-bold text-success">{{ $stats['peserta_aktif'] }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded p-2 text-center">
                                    <small class="text-muted">Selesai</small>
                                    <div class="fw-bold text-primary">{{ $stats['peserta_selesai'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Laporan -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Info Laporan</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <small>Laporan akan didownload dalam format PDF</small>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <small>Data real-time dari database</small>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <small>Laporan dapat difilter berdasarkan periode</small>
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                <small>Format laporan professional dan terstruktur</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomDate() {
            const periode = document.getElementById('periode').value;
            const customDateRange = document.getElementById('custom-date-range');
            
            if (periode === 'custom') {
                customDateRange.style.display = 'block';
                document.getElementById('tanggal_mulai').required = true;
                document.getElementById('tanggal_selesai').required = true;
            } else {
                customDateRange.style.display = 'none';
                document.getElementById('tanggal_mulai').required = false;
                document.getElementById('tanggal_selesai').required = false;
            }
        }

        function previewLaporan() {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            
            // Build query string for preview
            const params = new URLSearchParams();
            for (let [key, value] of formData.entries()) {
                if (value) params.append(key, value);
            }
            
            // Open preview in new tab
            window.open(`{{ route('admin.laporan.preview') }}?${params.toString()}`, '_blank');
        }
    </script>
</x-layout>