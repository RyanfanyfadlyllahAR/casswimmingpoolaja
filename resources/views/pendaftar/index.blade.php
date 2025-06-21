
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <h1 class="text-center mb-4">DAFTAR PENDAFTAR</h1>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Pendaftar</h5>
                <a href="{{ route('pendaftar.create') }}" class="btn btn-primary">Tambah Pendaftar</a>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Paket</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftars as $pendaftar)
                            <tr>
                                <td>{{ $pendaftar->nama }}</td>
                                <td>{{ $pendaftar->email }}</td>
                                <td>{{ $pendaftar->no_telepon }}</td>
                                <td>{{ $pendaftar->paket_dipilih }}</td>
                                <td>
                                    <span class="badge bg-{{ $pendaftar->status_pendaftaran == 'diterima' ? 'success' : ($pendaftar->status_pendaftaran == 'ditolak' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($pendaftar->status_pendaftaran) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pendaftar.show', $pendaftar->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('pendaftar.edit', $pendaftar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('pendaftar.destroy', $pendaftar->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>