<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Cas Swimming Pool
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRenang" aria-controls="navbarRenang" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" >
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('fasilitas') ? 'active' : '' }}" href="/fasilitas">Fasilitas</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('galeri') ? 'active' : '' }}" href="/galeri">Galeri</a></li>
        <li class="nav-item"><a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak">Kontak</a></li>
      </ul>
      <ul class="navbar-nav">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              {{ Auth::user()->nama_lengkap }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
              @if(Auth::user()->is_admin)
                <li><a class="dropdown-item" href="/admin/dashboard">Admin Panel</a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="/masuk" class="btn fw-semibold text-white" style="background-color: #fd7e14;">
              <i class="bi bi-box-arrow-in-right"></i> Masuk/Daftar
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
