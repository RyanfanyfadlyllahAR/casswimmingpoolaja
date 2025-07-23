<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Hero Carousel Section -->
  <div id="heroCarousel" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('img/atlite.jpg') }}" class="d-block w-100 hero-image" alt="Pelatihan Renang Profesional">
        <div class="carousel-caption d-none d-md-block">
          <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">Belajar Renang Bersama Pelatih Profesional</h1>
            <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Tingkatkan kemampuan renang Anda dengan metode pelatihan modern dan fasilitas terbaik</p>
            <div class="animate__animated animate__fadeInUp animate__delay-2s">
              <a href="/kursus" class="btn btn-primary btn-lg me-3">
                <i class="bi bi-water"></i> Daftar Kursus
              </a>
              <a href="/tentang" class="btn btn-outline-light btn-lg">
                <i class="bi bi-info-circle"></i> Tentang Kami
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="carousel-item">
        <img src="{{ asset('img/a.jpg') }}" class="d-block w-100 hero-image" alt="Fasilitas Kolam Renang">
        <div class="carousel-caption d-none d-md-block">
          <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3">Fasilitas Kolam Renang Berkelas</h1>
            <p class="lead mb-4">Kolam renang dengan standar internasional untuk kenyamanan dan keamanan pembelajaran</p>
            <div>
              <a href="/fasilitas" class="btn btn-success btn-lg me-3">
                <i class="bi bi-building"></i> Lihat Fasilitas
              </a>
              <a href="/galeri" class="btn btn-outline-light btn-lg">
                <i class="bi bi-images"></i> Galeri Foto
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="carousel-item">
        <img src="{{ asset('img/b.jpg') }}" class="d-block w-100 hero-image" alt="Komunitas Renang">
        <div class="carousel-caption d-none d-md-block">
          <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3">Bergabung dengan Komunitas Renang</h1>
            <p class="lead mb-4">Lebih dari sekedar belajar renang - temukan teman baru dan raih prestasi bersama</p>
            <div>
              <a href="/kontak" class="btn btn-warning btn-lg me-3">
                <i class="bi bi-people"></i> Hubungi Kami
              </a>
              <a href="/daftar" class="btn btn-outline-light btn-lg">
                <i class="bi bi-person-plus"></i> Daftar Sekarang
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Quick Stats Section -->
  <section class="py-5 bg-primary text-white">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-3 mb-4">
          <div class="stat-item">
            <i class="bi bi-people display-3 mb-3"></i>
            <h3 class="counter" data-target="500">0</h3>
            <p class="lead">Peserta Aktif</p>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="stat-item">
            <i class="bi bi-person-check display-3 mb-3"></i>
            <h3 class="counter" data-target="15">0</h3>
            <p class="lead">Instruktur Berpengalaman</p>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="stat-item">
            <i class="bi bi-award display-3 mb-3"></i>
            <h3 class="counter" data-target="1200">0</h3>
            <p class="lead">Lulusan Bersertifikat</p>
          </div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="stat-item">
            <i class="bi bi-calendar-check display-3 mb-3"></i>
            <h3 class="counter" data-target="5">0</h3>
            <p class="lead">Tahun Pengalaman</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Mengapa Memilih CAS Swimming Pool?</h2>
        <p class="lead text-muted">Kami berkomitmen memberikan pelayanan terbaik untuk perjalanan renang Anda</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Instruktur Bersertifikat</h4>
            <p class="text-muted">Pelatih profesional dengan sertifikasi nasional dan pengalaman mengajar lebih dari 5 tahun</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-water text-info" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Fasilitas Modern</h4>
            <p class="text-muted">Kolam renang standar dengan sistem filtrasi canggih dan peralatan latihan lengkap</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-clock text-warning" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Jadwal Fleksibel</h4>
            <p class="text-muted">Berbagai pilihan waktu latihan dari pagi hingga malam sesuai kebutuhan Anda</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Kelas Kecil</h4>
            <p class="text-muted">Maksimal 8 peserta per kelas untuk perhatian personal yang optimal</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-trophy text-danger" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Program Prestasi</h4>
            <p class="text-muted">Pelatihan khusus untuk kompetisi dan pengembangan bakat renang</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card h-100 p-4 text-center border rounded-3 shadow-sm">
            <div class="feature-icon mb-3">
              <i class="bi bi-patch-check text-primary" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">Sertifikat Resmi</h4>
            <p class="text-muted">Dapatkan sertifikat kelulusan yang diakui secara nasional</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Programs Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Program Kursus Kami</h2>
        <p class="lead text-muted">Pilih program yang sesuai dengan level dan kebutuhan Anda</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="program-card card h-100 shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center">
              <i class="bi bi-droplet display-4 mb-2"></i>
              <h4>Pemula (Beginner)</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li><i class="bi bi-check-circle text-success me-2"></i>Pengenalan air dan floating</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Teknik pernapasan dasar</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Gerakan kaki dan tangan</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Renang gaya bebas basic</li>
              </ul>
              <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Durasi:</strong></span>
                  <span>8 pertemuan</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Biaya:</strong></span>
                  <span class="text-primary fw-bold">Rp 500.000</span>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent">
              <a href="/kursus" class="btn btn-primary w-100">Daftar Sekarang</a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="program-card card h-100 shadow-sm border-0">
            <div class="card-header bg-success text-white text-center">
              <i class="bi bi-water display-4 mb-2"></i>
              <h4>Menengah (Intermediate)</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li><i class="bi bi-check-circle text-success me-2"></i>Penyempurnaan gaya bebas</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Teknik gaya punggung</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Koordinasi gerakan</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Latihan stamina</li>
              </ul>
              <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Durasi:</strong></span>
                  <span>10 pertemuan</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Biaya:</strong></span>
                  <span class="text-success fw-bold">Rp 700.000</span>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent">
              <a href="/kursus" class="btn btn-success w-100">Daftar Sekarang</a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="program-card card h-100 shadow-sm border-0">
            <div class="card-header bg-warning text-dark text-center">
              <i class="bi bi-award display-4 mb-2"></i>
              <h4>Lanjutan (Advanced)</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li><i class="bi bi-check-circle text-success me-2"></i>4 gaya renang lengkap</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Teknik start dan turn</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Persiapan kompetisi</li>
                <li><i class="bi bi-check-circle text-success me-2"></i>Program conditioning</li>
              </ul>
              <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Durasi:</strong></span>
                  <span>12 pertemuan</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span><strong>Biaya:</strong></span>
                  <span class="text-warning fw-bold">Rp 900.000</span>
                </div>
              </div>
            </div>
            <div class="card-footer bg-transparent">
              <a href="/kursus" class="btn btn-warning w-100">Daftar Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Apa Kata Mereka?</h2>
        <p class="lead text-muted">Testimoni dari peserta yang telah merasakan pengalaman belajar di CAS Swimming Pool</p>
      </div>
      
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="testimonial-card text-center p-4">
                  <div class="mb-4">
                    <i class="bi bi-quote text-primary" style="font-size: 3rem;"></i>
                  </div>
                  <blockquote class="blockquote mb-4">
                    <p class="lead">"Instruktur di CAS Swimming Pool sangat sabar dan profesional. Dalam 2 bulan saya sudah bisa berenang dengan percaya diri!"</p>
                  </blockquote>
                  <div class="d-flex align-items-center justify-content-center">
                    <img src="https://via.placeholder.com/60x60/007bff/ffffff?text=AS" class="rounded-circle me-3" alt="Avatar">
                    <div class="text-start">
                      <h5 class="mb-0">Andi Setiawan</h5>
                      <small class="text-muted">Peserta Program Pemula</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="testimonial-card text-center p-4">
                  <div class="mb-4">
                    <i class="bi bi-quote text-primary" style="font-size: 3rem;"></i>
                  </div>
                  <blockquote class="blockquote mb-4">
                    <p class="lead">"Fasilitas kolam yang bersih dan modern, plus jadwal yang fleksibel membuat saya betah latihan di sini."</p>
                  </blockquote>
                  <div class="d-flex align-items-center justify-content-center">
                    <img src="https://via.placeholder.com/60x60/28a745/ffffff?text=SR" class="rounded-circle me-3" alt="Avatar">
                    <div class="text-start">
                      <h5 class="mb-0">Sari Rahayu</h5>
                      <small class="text-muted">Peserta Program Menengah</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="testimonial-card text-center p-4">
                  <div class="mb-4">
                    <i class="bi bi-quote text-primary" style="font-size: 3rem;"></i>
                  </div>
                  <blockquote class="blockquote mb-4">
                    <p class="lead">"Berkat program lanjutan di CAS, saya berhasil menjuarai kompetisi renang tingkat kota. Terima kasih!"</p>
                  </blockquote>
                  <div class="d-flex align-items-center justify-content-center">
                    <img src="https://via.placeholder.com/60x60/ffc107/000000?text=RA" class="rounded-circle me-3" alt="Avatar">
                    <div class="text-start">
                      <h5 class="mb-0">Rizky Aditya</h5>
                      <small class="text-muted">Peserta Program Lanjutan</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-5 bg-gradient-primary text-white">
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 class="display-5 fw-bold mb-3">Siap Memulai Perjalanan Renang Anda?</h2>
          <p class="lead mb-4">Bergabunglah dengan ribuan peserta yang telah merasakan pengalaman belajar renang terbaik bersama kami</p>
          <div class="cta-buttons">
            <a href="/daftar" class="btn btn-light btn-lg me-3 mb-3">
              <i class="bi bi-person-plus"></i> Daftar Gratis
            </a>
            <a href="/kontak" class="btn btn-outline-light btn-lg mb-3">
              <i class="bi bi-telephone"></i> Konsultasi Gratis
            </a>
          </div>
          <div class="mt-4">
            <small class="opacity-75">
              <i class="bi bi-shield-check me-1"></i>
              Gratis konsultasi • Jaminan belajar sampai bisa • Sertifikat resmi
            </small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Info Section -->
  <section class="py-4 bg-dark text-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="contact-info d-flex flex-wrap">
            <div class="me-4 mb-2">
              <i class="bi bi-geo-alt text-primary me-2"></i>
              <span>Pandeglang, Banten</span>
            </div>
            <div class="me-4 mb-2">
              <i class="bi bi-telephone text-primary me-2"></i>
              <span>0812-3456-7890</span>
            </div>
            <div class="me-4 mb-2">
              <i class="bi bi-envelope text-primary me-2"></i>
              <span>info@casswimmingpool.com</span>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-md-end">
          <div class="social-links">
            <span class="me-3">Ikuti Kami:</span>
            <a href="https://instagram.com/cspprivaterenang" class="text-white me-3" target="_blank">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="text-white me-3">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="https://wa.me/6281234567890" class="text-white" target="_blank">
              <i class="bi bi-whatsapp"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Custom Styles -->
  <style>
    .hero-image {
      height: 700px;
      object-fit: cover;
      filter: brightness(0.7);
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
    }
    
    .carousel-caption {
      bottom: 20%;
    }
    
    .feature-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }
    
    .program-card {
      transition: transform 0.3s ease;
    }
    
    .program-card:hover {
      transform: translateY(-5px);
    }
    
    .stat-item {
      transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
      transform: scale(1.05);
    }
    
    .bg-gradient-primary {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .testimonial-card {
      background: rgba(255,255,255,0.05);
      border-radius: 15px;
      backdrop-filter: blur(10px);
    }
    
    .cta-buttons .btn {
      min-width: 180px;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate__fadeInUp {
      animation: fadeInUp 1s ease-out;
    }
    
    .animate__delay-1s {
      animation-delay: 0.5s;
    }
    
    .animate__delay-2s {
      animation-delay: 1s;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero-image {
        height: 500px;
      }
      
      .display-5 {
        font-size: 2rem;
      }
      
      .display-4 {
        font-size: 1.8rem;
      }
      
      .carousel-caption {
        bottom: 10%;
      }
      
      .hero-content h1 {
        font-size: 1.5rem;
      }
      
      .hero-content p {
        font-size: 1rem;
      }
      
      .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 1rem;
      }
    }
  </style>

  <!-- Custom JavaScript -->
  <script>
    // Counter Animation
    function animateCounters() {
      const counters = document.querySelectorAll('.counter');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const target = parseInt(entry.target.getAttribute('data-target'));
            let current = 0;
            const increment = target / 100;
            
            const updateCounter = () => {
              current += increment;
              if (current < target) {
                entry.target.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
              } else {
                entry.target.textContent = target;
              }
            };
            
            updateCounter();
            observer.unobserve(entry.target);
          }
        });
      });
      
      counters.forEach(counter => observer.observe(counter));
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
    
    // Initialize animations when page loads
    document.addEventListener('DOMContentLoaded', function() {
      animateCounters();
      
      // Add loading animation to cards
      const cards = document.querySelectorAll('.feature-card, .program-card');
      cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, index * 100);
      });
    });
    
    // Auto-pause carousel on hover
    const carousel = document.querySelector('#heroCarousel');
    carousel.addEventListener('mouseenter', () => {
      bootstrap.Carousel.getInstance(carousel).pause();
    });
    
    carousel.addEventListener('mouseleave', () => {
      bootstrap.Carousel.getInstance(carousel).cycle();
    });
    
    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const rate = scrolled * -0.5;
      const heroImages = document.querySelectorAll('.hero-image');
      
      heroImages.forEach(image => {
        image.style.transform = `translateY(${rate}px)`;
      });
    });
  </script>

  <!-- Animate.css CDN for animations -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</x-layout>