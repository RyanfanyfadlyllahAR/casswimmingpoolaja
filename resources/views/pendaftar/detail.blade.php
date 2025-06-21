
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <h1 class="text-center mb-4">DETAIL PENDAFTAR</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Data Pribadi</h5>
            </div>
            
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Nama</div>
                    <div class="col-md-9">{{ $pendaftar->nama }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Email</div>
                    <div class="col-md-9">{{ $pendaftar->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">No Telepon</div>
                    <div class="col-md-9">{{ $pendaftar->no_telepon }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Alamat</div>
                    <div class="col-md-9">{{ $pendaftar->alamat }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Paket Dipilih</div>
                    <div class="col-md-9">{{ $pendaftar->paket_dipilih }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Status Pendaftaran</div>
                    <div class="col-md-9">
                        <span class="badge bg-{{ $pendaftar->status_pendaftaran == 'diterima' ? 'success' : ($pendaftar->status_pendaftaran == 'ditolak' ? 'danger' : 'warning') }}">
                            {{ ucfirst($pendaftar->status_pendaftaran) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Persyaratan Dokumen</h5>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kartu Keluarga</td>
                                <td><span class="badge bg-success">Sudah Upload</span></td>
                                <td>Dokumen lengkap</td>
                            </tr>
                            <tr>
                                <td>Surat Keterangan Sehat</td>
                                <td><span class="badge bg-danger">Belum Upload</span></td>
                                <td>Harap segera melengkapi</td>
                            </tr>
                            <tr>
                                <td>Pas Foto 3x4</td>
                                <td><span class="badge bg-success">Sudah Upload</span></td>
                                <td>Dokumen lengkap</td>
                            </tr>
                            <tr>
                                <td>Bukti Pembayaran</td>
                                <td><span class="badge bg-warning">Menunggu Verifikasi</span></td>
                                <td>Sedang diverifikasi admin</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('pendaftar.show', $pendaftar->id) }}" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</x-layout>