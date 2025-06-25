<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container py-4">
        <h1 class="mb-4">Daftar Peserta</h1>
        <a href="{{ route('peserta.create') }}" class="btn btn-primary mb-3">Tambah Peserta</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertas as $peserta)
                <tr>
                    <td>{{ $peserta->nama }}</td>
                    <td>{{ $peserta->email }}</td>
                    <td>{{ $peserta->no_telepon }}</td>
                    <td>{{ $peserta->alamat }}</td>
                    <td>
                        <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>