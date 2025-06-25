<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-warning text-dark rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-pencil"></i> {{ $title }}</h1>
                    <p class="mb-0">Edit informasi kursus renang yang sudah ada.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('admin.kursus') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kursus
                </a>
                <a href="{{ route('admin.kursus.show', $kursus) }}" class="btn btn-info">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Edit Kursus</h5>
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

                        <form action="{{ route('admin.kursus.update', $kursus) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_kursus" class="form-label">Nama Kursus <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_kursus" name="nama_kursus" 
                                               value="{{ old('nama_kursus', $kursus->nama_kursus) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="durasi" class="form-label">Durasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="durasi" name="durasi" 
                                               value="{{ old('durasi', $kursus->durasi) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="biaya" class="form-label">Biaya (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="biaya" name="biaya" 
                                               value="{{ old('biaya', $kursus->biaya) }}" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                                               value="{{ old('tanggal_mulai', $kursus->tanggal_mulai->format('Y-m-d')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" 
                                               value="{{ old('tanggal_selesai', $kursus->tanggal_selesai->format('Y-m-d')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif" {{ old('status', $kursus->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ old('status', $kursus->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.kursus') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle"></i> Update Kursus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>