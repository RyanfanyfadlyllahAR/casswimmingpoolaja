<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

   <div class="container mt-5">
       <div class="row justify-content-center">
           <div class="col-md-9">
               <div class="card shadow-sm">
                   <div class="card-header text-black">
                       <h4 class="mb-0">Daftar</h4>
                   </div>
                   <div class="card-body">
                       <form action="/daftar" method="POST">
                        @csrf
                        <img src="{{ asset('img/logo csp.jpg') }}" alt="" width="100" class="d-block mx-auto mb-3">
                        <div class="row justify-content-center">
                            <h2 class="text-center mb-2">Cas Swimming Pool</h2>
                            <p class="text-center mb-4" style="color: #6c757d;">Silakan isi data diri Anda untuk mendaftar.</p>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis" name="jenis" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat" name="tempat" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Kartu Keluarga</label>
                            <input type="file" class="form-control" id="upload" name="upload" required>
                        </div>
                        <div class="mb-3">
                            <label for="asal" class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal" name="asal" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_telepon" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" required>
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