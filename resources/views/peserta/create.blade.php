<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-success text-white rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-plus-circle"></i> {{ $title }}</h1>
                    <p class="mb-0">Tambahkan peserta baru ke dalam sistem kursus renang.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Peserta
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-form"></i> Form Tambah Peserta</h5>
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

                        <form action="{{ route('peserta.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                        <select class="form-select" id="user_id" name="user_id" required>
                                            <option value="">Pilih User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->nama_lengkap }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kursus_id" class="form-label">Kursus <span class="text-danger">*</span></label>
                                        <select class="form-select" id="kursus_id" name="kursus_id" required>
                                            <option value="">Pilih Kursus</option>
                                            @foreach($kursus as $item)
                                                <option value="{{ $item->id }}" {{ old('kursus_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kursus }} - Rp {{ number_format($item->biaya, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jadwal_id" class="form-label">Jadwal <span class="text-danger">*</span></label>
                                        <select class="form-select" id="jadwal_id" name="jadwal_id" required>
                                            <option value="">Pilih Jadwal</option>
                                        </select>
                                        <small class="text-muted">Jadwal akan muncul setelah memilih kursus</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_pembayaran" class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status_pembayaran" name="status_pembayaran" required>
                                            <option value="">Pilih Status Pembayaran</option>
                                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="pending" {{ old('status_pembayaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="failed" {{ old('status_pembayaran') == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" 
                                               value="{{ old('tanggal_daftar', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('peserta.index') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Simpan Peserta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kursus_id').addEventListener('change', function() {
            const kursusId = this.value;
            const jadwalSelect = document.getElementById('jadwal_id');
            
            jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
            
            if (kursusId) {
                @foreach($jadwals as $jadwal)
                    if ({{ $jadwal->kursus_id }} == kursusId) {
                        const option = document.createElement('option');
                        option.value = {{ $jadwal->id }};
                        option.textContent = '{{ $jadwal->hari }}, {{ $jadwal->jam_mulai->format("H:i") }}-{{ $jadwal->jam_selesai->format("H:i") }} ({{ $jadwal->instruktur->nama_instruktur }})';
                        jadwalSelect.appendChild(option);
                    }
                @endforeach
            }
        });
    </script>
</x-layout>