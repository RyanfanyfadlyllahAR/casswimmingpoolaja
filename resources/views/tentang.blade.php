<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Hero Section -->
  <section class="hero-about py-5 bg-gradient-primary text-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInLeft">
              Tentang CAS Swimming Pool
            </h1>
            <p class="lead mb-4 animate__animated animate__fadeInLeft animate__delay-1s">
              Lebih dari sekedar tempat belajar renang - kami adalah komunitas yang membangun kepercayaan diri dan prestasi melalui air
            </p>
            <div class="animate__animated animate__fadeInLeft animate__delay-2s">
              <a href="/kursus" class="btn btn-light btn-lg me-3">
                <i class="bi bi-water"></i> Lihat Program
              </a>
              <a href="/kontak" class="btn btn-outline-light btn-lg">
                <i class="bi bi-telephone"></i> Hubungi Kami
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 text-center">
          <div class="logo-container animate__animated animate__fadeInRight">
            <img src="{{ asset('img/logo csp.jpg') }}" alt="Logo CAS Swimming Pool" 
                 class="img-fluid rounded-circle shadow-lg logo-hover" style="max-width: 300px;">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Company Story Section -->
  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="story-card p-5 bg-light rounded-4 shadow-sm">
            <div class="text-center mb-5">
              <h2 class="display-5 fw-bold mb-3">Cerita Kami</h2>
              <div class="underline mx-auto"></div>
            </div>
            
            <div class="story-content">
              <p class="lead text-center mb-5">
                CAS Swimming Pool merupakan lembaga kursus renang yang berlokasi di Pandeglang, Banten. 
                Didirikan dengan tujuan untuk mengembangkan keterampilan renang bagi semua kalangan, 
                CAS Swimming Pool berkomitmen untuk menciptakan suasana belajar yang aman, menyenangkan, dan profesional.
              </p>
              
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="feature-highlight p-4 h-100 bg-white rounded-3 shadow-sm">
                    <div class="feature-icon mb-3">
                      <i class="bi bi-award text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="mb-3">Pelatih Berpengalaman</h4>
                    <p class="mb-0">Dengan dukungan pelatih berpengalaman dan metode pelatihan modern yang telah teruji</p>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="feature-highlight p-4 h-100 bg-white rounded-3 shadow-sm">
                    <div class="feature-icon mb-3">
                      <i class="bi bi-heart text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="mb-3">Pembelajaran Menyenangkan</h4>
                    <p class="mb-0">CAS Swimming Pool hadir sebagai tempat ideal untuk belajar renang secara serius maupun rekreasional</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-5">
        <!-- Vision -->
        <div class="col-lg-6">
          <div class="vision-card h-100">
            <div class="card border-0 shadow-lg h-100 vision-hover">
              <div class="card-header bg-primary text-white text-center py-4">
                <i class="bi bi-eye display-4 mb-3"></i>
                <h3 class="fw-bold mb-0">VISI</h3>
              </div>
              <div class="card-body p-4 d-flex align-items-center">
                <div>
                  <p class="lead text-center mb-0">
                    Menjadi lembaga kursus renang terpercaya yang mencetak perenang berprestasi, sehat, 
                    dan percaya diri dengan memadukan teknik pelatihan profesional dan pembelajaran yang menyenangkan.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mission -->
        <div class="col-lg-6">
          <div class="mission-card h-100">
            <div class="card border-0 shadow-lg h-100 mission-hover">
              <div class="card-header bg-success text-white text-center py-4">
                <i class="bi bi-bullseye display-4 mb-3"></i>
                <h3 class="fw-bold mb-0">MISI</h3>
              </div>
              <div class="card-body p-4">
                <ol class="mission-list">
                  <li class="mb-3">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Mengembangkan kemampuan renang dengan metode pelatihan yang sesuai untuk berbagai usia dan tingkat keahlian.
                  </li>
                  <li class="mb-3">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Menanamkan nilai kedisplinan dan kepercayaan diri melalui kegiatan olahraga renang.
                  </li>
                  <li class="mb-3">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Meningkatkan kesadaran pentingnya olahraga air sebagai bagian dari gaya hidup sehat.
                  </li>
                  <li class="mb-3">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Menyediakan pelatihan berkualitas tinggi dengan pelatih profesional dan fasilitas aman dan nyaman.
                  </li>
                  <li class="mb-0">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Mendorong partisipasi peserta dalam kompetisi renang untuk mengasah keterampilan dan membangun prestasi.
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Nilai-Nilai Kami</h2>
        <p class="lead text-muted">Prinsip-prinsip yang menjadi fondasi pelayanan terbaik kami</p>
        <div class="underline mx-auto"></div>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-primary bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-shield-check text-primary" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Keamanan</h4>
            <p class="text-muted">Keselamatan peserta adalah prioritas utama dalam setiap sesi pelatihan</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-success bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-trophy text-success" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Prestasi</h4>
            <p class="text-muted">Mendorong setiap peserta untuk mencapai potensi terbaik mereka</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-warning bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-people text-warning" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Komunitas</h4>
            <p class="text-muted">Membangun lingkungan yang supportif dan saling mendukung</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-info bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-lightbulb text-info" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Inovasi</h4>
            <p class="text-muted">Terus mengembangkan metode pembelajaran yang efektif dan modern</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-danger bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-heart text-danger" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Passion</h4>
            <p class="text-muted">Dedikasi tinggi dalam mengembangkan talenta renang setiap peserta</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="value-card text-center p-4 h-100 bg-white rounded-3 shadow-sm value-hover">
            <div class="value-icon mb-4">
              <div class="icon-circle bg-dark bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-gem text-dark" style="font-size: 2rem;"></i>
              </div>
            </div>
            <h4 class="fw-bold mb-3">Kualitas</h4>
            <p class="text-muted">Standar pelatihan tinggi dengan fasilitas dan instruktur terbaik</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Tim Profesional Kami</h2>
        <p class="lead text-muted">Instruktur berpengalaman dan bersertifikat siap membimbing perjalanan renang Anda</p>
        <div class="underline mx-auto"></div>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="team-highlight bg-white rounded-4 shadow-lg p-5">
            <div class="text-center">
              <div class="team-icon mb-4">
                <i class="bi bi-people-fill text-primary" style="font-size: 4rem;"></i>
              </div>
              <h3 class="fw-bold mb-4">Instruktur Bersertifikat Nasional</h3>
              <p class="lead mb-4">
                Tim instruktur kami terdiri dari pelatih bersertifikat dengan pengalaman minimal 5 tahun 
                dalam mengajar renang untuk berbagai tingkat usia dan kemampuan.
              </p>
              <div class="row g-4 mt-4">
                <div class="col-md-4">
                  <div class="stat-item">
                    <h3 class="text-primary fw-bold">15+</h3>
                    <p class="mb-0">Instruktur Aktif</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="stat-item">
                    <h3 class="text-success fw-bold">5+</h3>
                    <p class="mb-0">Tahun Pengalaman</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="stat-item">
                    <h3 class="text-warning fw-bold">100%</h3>
                    <p class="mb-0">Bersertifikat</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-5 bg-gradient-primary text-white">
    <div class="container text-center">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 class="display-5 fw-bold mb-3">Bergabunglah Dengan Kami</h2>
          <p class="lead mb-4">
            Mulai perjalanan renang Anda bersama instruktur profesional dan fasilitas terbaik
          </p>
          <div class="cta-buttons">
            <a href="/kursus" class="btn btn-light btn-lg me-3 mb-3">
              <i class="bi bi-water"></i> Lihat Program Kursus
            </a>
            <a href="/kontak" class="btn btn-outline-light btn-lg mb-3">
              <i class="bi bi-telephone"></i> Konsultasi Gratis
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    .bg-gradient-primary {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .hero-about {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      min-height: 500px;
    }
    
    .logo-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .logo-hover:hover {
      transform: scale(1.05) rotate(5deg);
      box-shadow: 0 20px 40px rgba(0,123,255,0.3);
    }
    
    .underline {
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #007bff, #0056b3);
      border-radius: 2px;
    }
    
    .feature-highlight {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .feature-highlight:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .vision-hover, .mission-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .vision-hover:hover, .mission-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .mission-list {
      list-style: none;
      padding-left: 0;
    }
    
    .mission-list li {
      display: flex;
      align-items-flex-start;
    }
    
    .value-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .value-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .team-highlight {
      transition: transform 0.3s ease;
    }
    
    .team-highlight:hover {
      transform: scale(1.02);
    }
    
    @media (max-width: 768px) {
      .hero-about {
        text-align: center;
        padding: 3rem 0;
      }
      
      .display-4 {
        font-size: 2rem;
      }
      
      .display-5 {
        font-size: 1.8rem;
      }
    }
  </style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</x-layout>