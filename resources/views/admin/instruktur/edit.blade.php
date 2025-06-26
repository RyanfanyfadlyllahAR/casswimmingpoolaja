<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-warning text-dark rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-pencil"></i> {{ $title }}</h1>
                    <p class="mb-0">Edit informasi instruktur yang sudah ada.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.instruktur') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Instruktur
                </a>
                <a href="{{ route('admin.instruktur.show', $instruktur) }}" class="btn btn-info">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Edit Instruktur</h5>
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

                        <form action="{{ route('admin.instruktur.update', $instruktur) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_instruktur" class="form-label">Nama Instruktur <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_instruktur" name="nama_instruktur" 
                                               value="{{ old('nama_instruktur', $instruktur->nama_instruktur) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $instruktur->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $instruktur->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telp" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp" 
                                               value="{{ old('no_telp', $instruktur->no_telp) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pengalaman" class="form-label">Pengalaman (Tahun) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="pengalaman" name="pengalaman" 
                                               value="{{ old('pengalaman', $instruktur->pengalaman) }}" min="0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sertifikat" class="form-label">Sertifikat</label>
                                        <input type="text" class="form-control" id="sertifikat" name="sertifikat" 
                                               value="{{ old('sertifikat', $instruktur->sertifikat) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif" {{ old('status', $instruktur->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ old('status', $instruktur->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="keahlian" class="form-label">Keahlian & Spesialisasi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="keahlian" name="keahlian" rows="4" required>{{ old('keahlian', $instruktur->keahlian) }}</textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.instruktur') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle"></i> Update Instruktur
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>