<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-black">
                        <h4 class="mb-0">Daftar Akun Baru</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/daftar" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="upload" class="form-label">Upload Kartu Keluarga</label>
                                        <input type="file" class="form-control" id="upload" name="upload" accept=".jpg,.jpeg,.png,.pdf" required>
                                        <small class="text-muted">Format: JPG, PNG, PDF (Max: 2MB)</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="asal" class="form-label">Asal Sekolah</label>
                                        <input type="text" class="form-control" id="asal" name="asal" value="{{ old('asal') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <small class="text-muted">Minimal 6 karakter</small>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        </form>
                        <div class="text-center mt-3">
                            <small>Sudah punya akun? Silakan </small><a href="/masuk">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>