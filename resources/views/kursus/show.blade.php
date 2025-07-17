<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kursus.index') }}">Daftar Kursus</a></li>
                        <li class="breadcrumb-item active">{{ $kursus->nama_kursus }}</li>
                    </ol>
                </nav>
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

        <!-- Detail Kursus -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-water"></i> {{ $kursus->nama_kursus }}</h4>
                    </div>
                    <div class="card-body">
                        <h5>Deskripsi Kursus</h5>
                        <p class="text-muted">{{ $kursus->deskripsi }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h6><i class="bi bi-info-circle"></i> Informasi Kursus</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $kursus->durasi }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Mulai:</strong></td>
                                        <td>{{ $kursus->tanggal_mulai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Selesai:</strong></td>
                                        <td>{{ $kursus->tanggal_selesai->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td><span class="badge bg-success">{{ ucfirst($kursus->status) }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-people"></i> Informasi Peserta</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><strong>Total Peserta:</strong></td>
                                        <td>{{ $kursus->pesertas->count() }} orang</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Biaya Kursus:</strong></td>
                                        <td class="text-primary"><strong>Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Tersedia -->
                <div class="card shadow mt-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-calendar3"></i> Jadwal Tersedia</h5>
                    </div>
                    <div class="card-body">
                        @if($jadwals->count() > 0)
                            <div class="row">
                                @foreach($jadwals as $jadwal)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-info">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="text-primary">{{ $jadwal->hari }}</h6>
                                                        <p class="mb-1">
                                                            <i class="bi bi-clock"></i>
                                                            {{ $jadwal->jam_mulai->format('H:i') }} - {{ $jadwal->jam_selesai->format('H:i') }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <i class="bi bi-person"></i>
                                                            <strong>{{ $jadwal->instruktur->nama_instruktur }}</strong>
                                                        </p>
                                                        <small class="text-muted">
                                                            Kapasitas: {{ $jadwal->kapasitasTersedia() }}/{{ $jadwal->kapasitas_maksimal }} tersisa
                                                        </small>
                                                    </div>
                                                    <div>
                                                        @if($jadwal->kapasitasTersedia() > 0)
                                                            <span class="badge bg-success">Tersedia</span>
                                                        @else
                                                            <span class="badge bg-danger">Penuh</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                                <h6 class="mt-3">Belum Ada Jadwal</h6>
                                <p class="text-muted">Jadwal untuk kursus ini belum tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Pendaftaran -->
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-clipboard-check"></i> Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        @auth
                            @if($sudahDaftar)
                                <div class="alert alert-success text-center">
                                    <i class="bi bi-check-circle"></i><br>
                                    <strong>Anda sudah terdaftar</strong><br>
                                    di kursus ini
                                </div>
                                <div class="d-grid">
                                    <a href="{{ route('kursus.ku') }}" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> Lihat Kursus Saya
                                    </a>
                                </div>
                            @else
                                @if($kursus->status === 'aktif' && $jadwals->count() > 0)
                                    <div class="text-center mb-3">
                                        <h4 class="text-primary">Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</h4>
                                        <small class="text-muted">Biaya kursus</small>
                                    </div>

                                    <!-- PERBAIKAN: Form menggunakan route yang benar -->
                                    <form action="{{ route('kursus.daftar', $kursus) }}" method="POST" id="daftarForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="jadwal_id" class="form-label">Pilih Jadwal <span class="text-danger">*</span></label>
                                            <select class="form-select" id="jadwal_id" name="jadwal_id" required>
                                                <option value="">-- Pilih Jadwal --</option>
                                                @foreach($jadwals as $jadwal)
                                                    @if($jadwal->kapasitasTersedia() > 0)
                                                        <option value="{{ $jadwal->id }}">
                                                            {{ $jadwal->hari }}, {{ $jadwal->jam_mulai->format('H:i') }}-{{ $jadwal->jam_selesai->format('H:i') }}
                                                            ({{ $jadwal->instruktur->nama_instruktur }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="d-grid">
                                            <button type="button" class="btn btn-primary btn-lg" onclick="showDaftarModal()">
                                                <i class="bi bi-plus-circle"></i> Daftar Sekarang
                                            </button>
                                        </div>
                                    </form>

                                    <small class="text-muted d-block text-center mt-2">
                                        Dengan mendaftar, Anda menyetujui syarat dan ketentuan.
                                    </small>
                                @else
                                    <div class="alert alert-warning text-center">
                                        <i class="bi bi-exclamation-triangle"></i><br>
                                        @if($jadwals->count() == 0)
                                            Jadwal belum tersedia
                                        @else
                                            Kursus ini sedang tidak tersedia
                                        @endif
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle"></i><br>
                                Silakan login untuk mendaftar kursus
                            </div>
                            <div class="d-grid gap-2">
                                <a href="/masuk" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                                <a href="/daftar" class="btn btn-outline-primary">
                                    <i class="bi bi-person-plus"></i> Daftar Akun
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Instruktur Info -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-people"></i> Instruktur</h6>
                    </div>
                    <div class="card-body">
                        @if($jadwals->count() > 0)
                            @foreach($jadwals->unique('instruktur_id') as $jadwal)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $jadwal->instruktur->nama_instruktur }}</h6>
                                        <small class="text-muted">{{ $jadwal->instruktur->pengalaman }} tahun pengalaman</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center">Instruktur belum ditentukan</p>
                        @endif
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="card shadow mt-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-star"></i> Fasilitas</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success"></i> Kolam renang standar</li>
                            <li><i class="bi bi-check text-success"></i> Pelatih bersertifikat</li>
                            <li><i class="bi bi-check text-success"></i> Peralatan latihan</li>
                            <li><i class="bi bi-check text-success"></i> Sertifikat kelulusan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Pendaftaran -->
    <div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">
                        <i class="bi bi-clipboard-check"></i> Konfirmasi Pendaftaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-water text-primary" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="text-center mb-3">Apakah Anda yakin ingin mendaftar kursus ini?</h6>

                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-primary">{{ $kursus->nama_kursus }}</h6>
                            <div class="row">
                                <div class="col-6">
                                    <small class="text-muted">Biaya:</small><br>
                                    <strong class="text-success">Rp {{ number_format($kursus->biaya, 0, ',', '.') }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Jadwal Dipilih:</small><br>
                                    <strong id="selectedJadwal">-</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle"></i>
                        <small>Dengan mendaftar, Anda menyetujui syarat dan ketentuan yang berlaku.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <button type="button" class="btn btn-primary" onclick="submitDaftar()">
                        <i class="bi bi-check-circle"></i> Ya, Daftar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDaftarModal() {
            const jadwalSelect = document.getElementById('jadwal_id');
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];

            if (!jadwalSelect.value) {
                alert('Silakan pilih jadwal terlebih dahulu!');
                return;
            }

            // Update jadwal yang dipilih di modal
            document.getElementById('selectedJadwal').textContent = selectedOption.text;

            // Tampilkan modal
            new bootstrap.Modal(document.getElementById('daftarModal')).show();
        }

        function submitDaftar() {
            // Submit form
            document.getElementById('daftarForm').submit();
        }
    </script>
</x-layout>
