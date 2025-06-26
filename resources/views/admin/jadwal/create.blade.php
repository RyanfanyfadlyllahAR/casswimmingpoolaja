<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-success text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-plus-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Buat jadwal kursus renang baru dengan mengisi form di bawah ini.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Jadwal
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Tambah Jadwal</h5>
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

                        <form action="{{ route('admin.jadwal.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kursus_id" class="form-label">Kursus <span class="text-danger">*</span></label>
                                        <select class="form-control" id="kursus_id" name="kursus_id" required>
                                            <option value="">Pilih Kursus</option>
                                            @foreach($kursus as $item)
                                                <option value="{{ $item->id }}" {{ old('kursus_id') == $item->id ? 'selected' : '' }}>
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
                                                <option value="{{ $instruktur->id }}" {{ old('instruktur_id') == $instruktur->id ? 'selected' : '' }}>
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
                                                <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
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
                                               value="{{ old('jam_mulai') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" 
                                               value="{{ old('jam_selesai') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kapasitas_maksimal" class="form-label">Kapasitas Maksimal <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="kapasitas_maksimal" name="kapasitas_maksimal" 
                                               value="{{ old('kapasitas_maksimal') }}" min="1" max="20" placeholder="8" required>
                                        <small class="text-muted">Maksimal 20 peserta per jadwal</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.jadwal') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Simpan Jadwal
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
                            <li>Jadwal yang berstatus "Aktif" akan muncul di daftar pendaftaran peserta</li>
                            <li>Gunakan status "Non-aktif" untuk jadwal yang belum siap dibuka</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>