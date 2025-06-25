<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

   <div class="container mt-5">
       <div class="row justify-content-center">
           <div class="col-md-6">
               <div class="card shadow-sm">
                   <div class="card-header  text-black ">
                       <h4 class="mb-0">Masuk</h4>
                   </div>
                   <div class="card-body">
                       <form action="/masuk" method="POST">
                        <img src="img/logo csp.jpg" alt="" width="100" class="d-block mx-auto mb-3">
                        <div class="row justify-content-center">
                            <h2 class="text-center mb-2">Cas Swimming Pool</h2>
                            <p class="text-center mb-4" style="color: #6c757d;">Selamat datang di Cas Swimming Pool.</p>
                        </div>
                           @csrf
                           <div class="mb-3">
                               <label for="email" class="form-label">Email</label>
                               <input type="email" class="form-control" id="email" name="email" required>
                           </div>
                           <div class="mb-3">
                               <label for="password" class="form-label">Kata Sandi</label>
                               <input type="password" class="form-control" id="password" name="password" required>
                           </div>
                           <button type="submit" class="btn btn-primary w-100">Masuk</button>
                       </form>
                      <div class="text-center mt-3">
                           <small>Belum Punya Akun? Silahkan </small><a href="/daftar">Daftar</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
</x-layout>
