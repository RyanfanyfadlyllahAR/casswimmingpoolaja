<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <h1 class="text-center mb-4">TAMBAH PENDAFTAR</h1>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah Pendaftar</h5>
            </div>
            
            <div class="card-body">
                <form action="{{ route('pendaftar.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                            value="{{ old('no_telepon') }}">
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                            rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket</label>
                        <input type="text" name="paket_dipilih" class="form-control @error('paket_dipilih') is-invalid @enderror" 
                            value="{{ old('paket_dipilih') }}">
                        @error('paket_dipilih')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Pendaftaran</label>
                        <select name="status_pendaftaran" class="form-control @error('status_pendaftaran') is-invalid @enderror">
                            <option value="pending" {{ old('status_pendaftaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diterima" {{ old('status_pendaftaran') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status_pendaftaran') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status_pendaftaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>