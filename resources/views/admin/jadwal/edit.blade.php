<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-warning text-dark rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-pencil"></i> {{ $title }}</h1>
                    <p class="mb-0">Edit informasi jadwal kursus renang yang sudah ada.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Jadwal
                </a>
                <a href="{{ route('admin.jadwal.show', $jadwal) }}" class="btn btn-info">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Edit Jadwal</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h6><i class="bi bi-exclamation-triangle"></i> Terjadi Kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.jadwal.update', $jadwal) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kursus_id" class="form-label">Kursus <span class="text-danger">*</span></label>
                                        <select class="form-control" id="kursus_id" name="kursus_id" required>
                                            <option value="">Pilih Kursus</option>
                                            @foreach($kursus as $item)
                                                <option value="{{ $item->id }}" {{ old('kursus_id', $jadwal->kursus_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kursus }} - {{ $item->durasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="instruktur_id" class="form-label">Instruktur <span class="text-danger">*</span></label>
                                        <select class="form-control" id="instruktur_id" name="instruktur_id" required>
                                            <option value="">Pilih Instruktur</option>
                                            @foreach($instrukturs as $instruktur)
                                                <option value="{{ $instruktur->id }}" {{ old('instruktur_id', $jadwal->instruktur_id) == $instruktur->id ? 'selected' : '' }}>
                                                    {{ $instruktur->nama_instruktur }} ({{ $instruktur->pengalaman }} tahun)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hari" class="form-label">Hari <span class="text-danger">*</span></label>
                                        <select class="form-control" id="hari" name="hari" required>
                                            <option value="">Pilih Hari</option>
                                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                                    {{ $hari }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" 
                                               value="{{ old('jam_mulai', $jadwal->jam_mulai->format('H:i')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" 
                                               value="{{ old('jam_selesai', $jadwal->jam_selesai->format('H:i')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kapasitas_maksimal" class="form-label">Kapasitas Maksimal <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="kapasitas_maksimal" name="kapasitas_maksimal" 
                                               value="{{ old('kapasitas_maksimal', $jadwal->kapasitas_maksimal) }}" min="1" max="20" required>
                                        <small class="text-muted">Maksimal 20 peserta per jadwal</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ old('status', $jadwal->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $jadwal->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                </select>
                            </div>

                            <!-- Info Peserta Aktif -->
                            @if($jadwal->pesertas()->where('status', 'aktif')->count() > 0)
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> 
                                    <strong>Perhatian:</strong> Jadwal ini memiliki {{ $jadwal->pesertas()->where('status', 'aktif')->count() }} peserta aktif. 
                                    Pastikan perubahan yang dilakukan tidak mengganggu jadwal peserta.
                                </div>
                            @endif
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle"></i> Update Jadwal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="row mt-4">
            <div class="col-lg-8 mx-auto">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6><i class="bi bi-lightbulb"></i> Tips:</h6>
                        <ul class="mb-0 small">
                            <li>Pastikan tidak ada konflik jadwal dengan instruktur yang sama pada hari dan jam yang sama</li>
                            <li>Kapasitas maksimal disarankan antara 5-15 peserta untuk efektivitas pembelajaran</li>
                            <li>Perubahan jadwal akan mempengaruhi peserta yang sudah terdaftar</li>
                            <li>Status "Non-aktif" akan menyembunyikan jadwal dari pendaftaran peserta baru</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>