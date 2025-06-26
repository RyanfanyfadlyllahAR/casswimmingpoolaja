<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-primary text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-person-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Perbarui informasi profil dan data pribadi Anda.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
                <a href="{{ route('user.edit-password') }}" class="btn btn-warning">
                    <i class="bi bi-key"></i> Ganti Password
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

        <!-- Form Edit Profil -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Edit Profil</h5>
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

                        <form action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <!-- Informasi Akun -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary border-bottom pb-2"><i class="bi bi-person-badge"></i> Informasi Akun</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username" 
                                               value="{{ old('username', $user->username) }}" required>
                                        <small class="text-muted">Username hanya boleh mengandung huruf, angka, dan underscore.</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Pribadi -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary border-bottom pb-2"><i class="bi bi-person"></i> Data Pribadi</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                               value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                                               value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                               value="{{ old('tanggal_lahir', $user->tanggal_lahir->format('Y-m-d')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telp" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="no_telp" name="no_telp" 
                                               value="{{ old('no_telp', $user->no_telp) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="asal_sekolah" class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" 
                                               value="{{ old('asal_sekolah', $user->asal_sekolah) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat & Dokumen -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary border-bottom pb-2"><i class="bi bi-geo-alt"></i> Alamat & Dokumen</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="4" required>{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
                                        <input type="file" class="form-control" id="foto_kk" name="foto_kk" accept="image/*">
                                        <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                        
                                        @if($user->foto_kk)
                                            <div class="mt-2">
                                                <small class="text-success">
                                                    <i class="bi bi-check-circle"></i> File saat ini: 
                                                    <a href="{{ Storage::url($user->foto_kk) }}" target="_blank">Lihat Foto KK</a>
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Foto KK (jika ada) -->
                            @if($user->foto_kk)
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary border-bottom pb-2"><i class="bi bi-image"></i> Foto KK Saat Ini</h6>
                                        <div class="text-center">
                                            <img src="{{ Storage::url($user->foto_kk) }}" alt="Foto KK" 
                                                 class="img-thumbnail" style="max-height: 300px;">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>