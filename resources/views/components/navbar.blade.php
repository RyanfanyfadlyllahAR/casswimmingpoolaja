<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Cas Swimming Pool
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRenang" aria-controls="navbarRenang" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" >
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('informasis') ? 'active' : '' }}" href="/informasis">Informasi</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('fasilitas') ? 'active' : '' }}" href="/fasilitas">Fasilitas</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('galeri') ? 'active' : '' }}" href="/galeri">Galeri</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak">Kontak</a></li>
      </ul>
    </div>
  </div>
</nav>
