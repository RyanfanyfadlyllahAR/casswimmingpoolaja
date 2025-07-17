<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary shadow-lg sticky-top">
  <div class="container">
    <!-- Brand Logo -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
      <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top rounded-circle me-2 logo-img">
      <span class="brand-text">
        <span class="main-title">CAS Swimming Pool</span>
        <small class="d-block text-light opacity-75 brand-subtitle">Private Swimming Course</small>
      </span>
    </a>

    <!-- Mobile Toggle Button -->
    <button class="navbar-toggler border-0 custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRenang" aria-controls="navbarRenang" aria-expanded="false" aria-label="Toggle navigation">
      <span class="toggler-icon"></span>
      <span class="toggler-icon"></span>
      <span class="toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarRenang">
      <!-- Main Navigation -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('/') ? 'active' : '' }}" href="/">
            <i class="bi bi-house-door me-1"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">
            <i class="bi bi-info-circle me-1"></i>
            <span>Tentang</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ Request::is('fasilitas') || Request::is('galeri') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-grid-3x3-gap me-1"></i>
            <span>Fasilitas & Galeri</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom shadow-lg">
            <li>
              <a class="dropdown-item dropdown-item-custom {{ Request::is('fasilitas') ? 'active' : '' }}" href="/fasilitas">
                <i class="bi bi-building text-info me-2"></i>
                <div>
                  <strong>Fasilitas</strong>
                  <small class="d-block text-muted">Kolam & Peralatan</small>
                </div>
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item dropdown-item-custom {{ Request::is('galeri') ? 'active' : '' }}" href="/galeri">
                <i class="bi bi-images text-warning me-2"></i>
                <div>
                  <strong>Galeri</strong>
                  <small class="d-block text-muted">Foto & Video</small>
                </div>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('kursus') ? 'active' : '' }}" href="/kursus">
            <i class="bi bi-water me-1"></i>
            <span>Program Kursus</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak">
            <i class="bi bi-telephone me-1"></i>
            <span>Kontak</span>
          </a>
        </li>
      </ul>

      <!-- Auth Section -->
      <ul class="navbar-nav">
        @auth
          <!-- Authenticated User Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle user-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center">
                <div class="user-avatar me-2">
                  <i class="bi bi-person-circle"></i>
                </div>
                <div class="user-info d-none d-md-block">
                  <span class="user-name">{{ Auth::user()->nama_lengkap }}</span>
                  <small class="d-block text-light opacity-75">
                    {{ Auth::user()->is_admin ? 'Administrator' : 'Member' }}
                  </small>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom user-dropdown-menu shadow-lg">
              <li class="dropdown-header">
                <div class="text-center">
                  <div class="user-avatar-large mb-2">
                    <i class="bi bi-person-circle text-primary"></i>
                  </div>
                  <strong>{{ Auth::user()->nama_lengkap }}</strong>
                  <small class="d-block text-muted">{{ Auth::user()->email }}</small>
                </div>
              </li>
              <li><hr class="dropdown-divider"></li>
              @if(!Auth::user()->is_admin)
                <li>
                  <a class="dropdown-item dropdown-item-custom" href="/dashboard">
                    <i class="bi bi-speedometer2 text-primary me-2"></i>
                    <span>Dashboard</span>
                  </a>
                </li>
              @endif
              @if(Auth::user()->is_admin)
                <li>
                  <a class="dropdown-item dropdown-item-custom" href="/admin/dashboard">
                    <i class="bi bi-gear-fill text-success me-2"></i>
                    <span>Admin Panel</span>
                  </a>
                </li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                  @csrf
                  <button type="submit" class="dropdown-item dropdown-item-custom text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span>Keluar</span>
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <!-- Guest Actions -->
          <li class="nav-item me-2">
            <a href="/masuk" class="btn btn-outline-light btn-auth">
              <i class="bi bi-box-arrow-in-right me-1"></i>
              <span>Masuk</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="/daftar" class="btn btn-warning btn-auth fw-semibold">
              <i class="bi bi-person-plus me-1"></i>
              <span>Daftar</span>
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- WhatsApp Floating Button -->
<div class="whatsapp-float">
  <a href="https://wa.me/6281234567890?text=Halo%20CAS%20Swimming%20Pool,%20saya%20ingin%20bertanya" target="_blank" class="whatsapp-btn" title="Chat WhatsApp">
    <i class="bi bi-whatsapp"></i>
    <span class="whatsapp-text">Chat Kami</span>
  </a>
</div>

<!-- Custom Styles -->
<style>
/* Gradient Background */
.bg-gradient-primary {
  background: linear-gradient(135deg, #007bff 0%, #0056b3 50%, #004085 100%);
}

/* Brand Styling */
.navbar-brand {
  transition: transform 0.3s ease;
}

.navbar-brand:hover {
  transform: scale(1.05);
}

.logo-img {
  transition: transform 0.3s ease;
  border: 2px solid rgba(255,255,255,0.3);
}

.navbar-brand:hover .logo-img {
  transform: rotate(360deg);
}

.brand-text .main-title {
  font-size: 1.2rem;
  font-weight: 700;
}

.brand-subtitle {
  font-size: 0.7rem;
  line-height: 1;
}

/* Custom Toggler */
.custom-toggler {
  padding: 0.5rem;
  position: relative;
  background: rgba(255,255,255,0.1);
  border-radius: 8px;
  transition: all 0.3s ease;
}

.custom-toggler:hover {
  background: rgba(255,255,255,0.2);
}

.toggler-icon {
  display: block;
  width: 25px;
  height: 3px;
  background: white;
  margin: 5px 0;
  border-radius: 2px;
  transition: all 0.3s ease;
}

.custom-toggler[aria-expanded="true"] .toggler-icon:nth-child(1) {
  transform: rotate(45deg) translate(6px, 6px);
}

.custom-toggler[aria-expanded="true"] .toggler-icon:nth-child(2) {
  opacity: 0;
}

.custom-toggler[aria-expanded="true"] .toggler-icon:nth-child(3) {
  transform: rotate(-45deg) translate(6px, -6px);
}

/* Navigation Links */
.nav-link-custom {
  position: relative;
  padding: 0.8rem 1rem !important;
  border-radius: 8px;
  transition: all 0.3s ease;
  margin: 0 0.2rem;
}

.nav-link-custom:hover {
  background: rgba(255,255,255,0.1);
  transform: translateY(-2px);
}

.nav-link-custom.active {
  background: rgba(255,255,255,0.2);
  color: #fff !important;
  font-weight: 600;
}

.nav-link-custom.active::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 50%;
  transform: translateX(-50%);
  width: 30px;
  height: 3px;
  background: #ffc107;
  border-radius: 2px;
}

/* Dropdown Menus */
.dropdown-menu-custom {
  border: none;
  border-radius: 12px;
  padding: 0.5rem 0;
  margin-top: 0.5rem;
  min-width: 250px;
  background: rgba(255,255,255,0.98);
  backdrop-filter: blur(10px);
}

.dropdown-item-custom {
  padding: 0.8rem 1.5rem;
  transition: all 0.3s ease;
  border-radius: 8px;
  margin: 0 0.5rem;
  display: flex;
  align-items: center;
}

.dropdown-item-custom:hover {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  transform: translateX(5px);
}

.dropdown-item-custom.active {
  background: rgba(0,123,255,0.1);
  color: #007bff;
  font-weight: 600;
}

/* User Dropdown */
.user-dropdown {
  padding: 0.5rem 1rem !important;
  border-radius: 50px;
  background: rgba(255,255,255,0.1);
  transition: all 0.3s ease;
}

.user-dropdown:hover {
  background: rgba(255,255,255,0.2);
}

.user-avatar {
  font-size: 1.8rem;
  color: #ffc107;
}

.user-avatar-large {
  font-size: 3rem;
  color: #007bff;
}

.user-name {
  font-weight: 600;
  font-size: 0.9rem;
}

.user-dropdown-menu {
  min-width: 280px;
}

.dropdown-header {
  padding: 1rem 1.5rem;
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  border-radius: 12px 12px 0 0;
}

/* Auth Buttons */
.btn-auth {
  padding: 0.6rem 1.2rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  border-width: 2px;
}

.btn-auth:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-outline-light.btn-auth:hover {
  background: white;
  color: #007bff;
  border-color: white;
}

.btn-warning.btn-auth:hover {
  background: #e0a800;
  border-color: #e0a800;
  color: white;
}

/* WhatsApp Floating Button */
.whatsapp-float {
  position: fixed;
  bottom: 20px;
  right: 20px;
}

.whatsapp-btn {
  display: flex;
  align-items: center;
  background: #25d366;
  color: white;
  padding: 12px 20px;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
  transition: all 0.3s ease;
  font-weight: 600;
}

.whatsapp-btn:hover {
  background: #22c55e;
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(37, 211, 102, 0.6);
}

.whatsapp-btn i {
  font-size: 1.5rem;
  margin-right: 8px;
}

.whatsapp-text {
  font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .navbar-collapse {
    background: rgba(0,0,0,0.95);
    border-radius: 12px;
    margin-top: 1rem;
    padding: 1rem;
  }

  .nav-link-custom {
    margin: 0.2rem 0;
  }

  .nav-link-custom.active::after {
    display: none;
  }

  .btn-auth {
    width: 100%;
    margin: 0.5rem 0;
  }

  .user-info {
    display: block !important;
  }

  .brand-subtitle {
    display: none;
  }

  .whatsapp-text {
    display: none;
  }

  .whatsapp-btn {
    width: 60px;
    height: 60px;
    padding: 0;
    justify-content: center;
    border-radius: 50%;
  }

  .whatsapp-btn i {
    margin: 0;
  }
}

@media (max-width: 575.98px) {
  .container {
    padding: 0 1rem;
  }

  .navbar-brand .main-title {
    font-size: 1rem;
  }

  .logo-img {
    width: 30px;
    height: 30px;
  }

  .whatsapp-float {
    bottom: 15px;
    right: 15px;
  }
}

/* Animation for navbar items */
@keyframes slideInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.navbar-nav .nav-item {
  animation: slideInDown 0.5s ease-out forwards;
}

.navbar-nav .nav-item:nth-child(1) { animation-delay: 0.1s; }
.navbar-nav .nav-item:nth-child(2) { animation-delay: 0.2s; }
.navbar-nav .nav-item:nth-child(3) { animation-delay: 0.3s; }
.navbar-nav .nav-item:nth-child(4) { animation-delay: 0.4s; }
.navbar-nav .nav-item:nth-child(5) { animation-delay: 0.5s; }

/* Scroll Effect */
.navbar.scrolled {
  background: rgba(0,123,255,0.95) !important;
  backdrop-filter: blur(10px);
}

/* Ripple effect */
.ripple {
  position: absolute;
  border-radius: 50%;
  background: rgba(255,255,255,0.4);
  transform: scale(0);
  animation: ripple-animation 0.6s linear;
  pointer-events: none;
}

@keyframes ripple-animation {
  to {
    transform: scale(4);
    opacity: 0;
  }
}

.btn-auth {
  position: relative;
  overflow: hidden;
}
</style>

<!-- Custom JavaScript -->
<script>
// Navbar scroll effect
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

// Close mobile menu when clicking on a link
document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
  link.addEventListener('click', () => {
    const navbarCollapse = document.querySelector('.navbar-collapse');
    if (navbarCollapse.classList.contains('show')) {
      const bsCollapse = new bootstrap.Collapse(navbarCollapse);
      bsCollapse.hide();
    }
  });
});

// Add ripple effect to buttons
document.querySelectorAll('.btn-auth').forEach(button => {
  button.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');

    this.appendChild(ripple);

    setTimeout(() => {
      ripple.remove();
    }, 600);
  });
});

// WhatsApp button pulse animation
setInterval(() => {
  const whatsappBtn = document.querySelector('.whatsapp-btn');
  if (whatsappBtn) {
    whatsappBtn.style.transform = 'scale(1.1)';
    setTimeout(() => {
      whatsappBtn.style.transform = '';
    }, 200);
  }
}, 5000);
</script>
