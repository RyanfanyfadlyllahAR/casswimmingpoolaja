<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Hero Section -->
  <section class="hero-gallery py-5 bg-gradient-info text-white">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
        Galeri Kegiatan
      </h1>
      <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        Lihat momen-momen berharga dari kegiatan pelatihan dan pencapaian peserta kami
      </p>
      <div class="gallery-stats d-flex justify-content-center gap-4 animate__animated animate__fadeInUp animate__delay-2s">
        <div class="stat-item">
          <h3 class="fw-bold">500+</h3>
          <small>Foto Kegiatan</small>
        </div>
        <div class="stat-item">
          <h3 class="fw-bold">100+</h3>
          <small>Momen Prestasi</small>
        </div>
      </div>
    </div>
  </section>

  <!-- Filter Section -->
  <section class="py-4 bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="filter-controls text-center">
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn active" data-filter="all">
              <i class="bi bi-grid"></i> Semua
            </button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-filter="training">
              <i class="bi bi-water"></i> Pelatihan
            </button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-filter="competition">
              <i class="bi bi-trophy"></i> Kompetisi
            </button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-filter="facility">
              <i class="bi bi-building"></i> Fasilitas
            </button>
            <button class="btn btn-outline-primary me-2 mb-2 filter-btn" data-filter="achievement">
              <i class="bi bi-award"></i> Prestasi
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Grid -->
  <section class="py-5">
    <div class="container">
      <div class="gallery-grid row g-4" id="galleryGrid">
        @php
          $images = [
            ['file' => '3.jpg', 'category' => 'training', 'title' => 'Pelatihan Teknik Dasar', 'description' => 'Peserta sedang belajar teknik renang gaya bebas'],
            ['file' => '8.jpg', 'category' => 'competition', 'title' => 'Persiapan Kompetisi', 'description' => 'Latihan intensif untuk persiapan kompetisi'],
            ['file' => '4.jpg', 'category' => 'training', 'title' => 'Sesi Pelatihan Grup', 'description' => 'Pelatihan berkelompok dengan instruktur profesional'],
            ['file' => '5.jpg', 'category' => 'facility', 'title' => 'Fasilitas Kolam Utama', 'description' => 'Kolam renang standar dengan fasilitas lengkap'],
            ['file' => '6.jpg', 'category' => 'achievement', 'title' => 'Pencapaian Peserta', 'description' => 'Momen kebanggaan peserta yang berhasil menguasai teknik'],
            ['file' => '7.jpg', 'category' => 'training', 'title' => 'Pelatihan Anak', 'description' => 'Program khusus untuk peserta usia dini'],
            ['file' => 'r.jpg', 'category' => 'competition', 'title' => 'Kompetisi Renang', 'description' => 'Peserta mengikuti kompetisi renang antar klub'],
            ['file' => 'yu.jpg', 'category' => 'achievement', 'title' => 'Sertifikasi Kelulusan', 'description' => 'Pemberian sertifikat untuk peserta yang lulus program']
          ]
        @endphp

        @foreach($images as $index => $image)
          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item" data-category="{{ $image['category'] }}">
            <div class="gallery-card h-100 bg-white rounded-4 shadow-sm overflow-hidden gallery-hover">
              <div class="image-container position-relative overflow-hidden">
                <img src="{{ asset('img/' . $image['file']) }}" 
                     class="gallery-image w-100" 
                     alt="{{ $image['title'] }}"
                     data-bs-toggle="modal" 
                     data-bs-target="#imageModal"
                     data-image="{{ asset('img/' . $image['file']) }}"
                     data-title="{{ $image['title'] }}"
                     data-description="{{ $image['description'] }}">
                
                <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                  <div class="overlay-content text-center text-white">
                    <i class="bi bi-zoom-in" style="font-size: 2rem;"></i>
                    <p class="mt-2 mb-0">Lihat Detail</p>
                  </div>
                </div>
                
                <div class="category-badge position-absolute top-3 start-3">
                  @if($image['category'] == 'training')
                    <span class="badge bg-primary"><i class="bi bi-water me-1"></i>Pelatihan</span>
                  @elseif($image['category'] == 'competition')
                    <span class="badge bg-warning"><i class="bi bi-trophy me-1"></i>Kompetisi</span>
                  @elseif($image['category'] == 'facility')
                    <span class="badge bg-success"><i class="bi bi-building me-1"></i>Fasilitas</span>
                  @else
                    <span class="badge bg-danger"><i class="bi bi-award me-1"></i>Prestasi</span>
                  @endif
                </div>
              </div>
              
              <div class="card-body p-3">
                <h6 class="card-title fw-bold mb-2">{{ $image['title'] }}</h6>
                <p class="card-text text-muted small mb-0">{{ $image['description'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Load More Button -->
      <div class="text-center mt-5">
        <button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
          <i class="bi bi-plus-circle me-2"></i>Tampilkan Lebih Banyak
        </button>
      </div>
    </div>
  </section>

  <!-- Image Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold" id="modalTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body p-0">
          <img id="modalImage" class="w-100" alt="">
          <div class="p-4">
            <p id="modalDescription" class="text-muted mb-3"></p>
            <div class="d-flex gap-2">
              <button class="btn btn-primary btn-sm" onclick="downloadImage()">
                <i class="bi bi-download me-1"></i>Download
              </button>
              <button class="btn btn-outline-primary btn-sm" onclick="shareImage()">
                <i class="bi bi-share me-1"></i>Bagikan
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-6 fw-bold mb-3">Pencapaian Dalam Angka</h2>
        <p class="lead text-muted">Prestasi yang membanggakan dari komunitas CAS Swimming Pool</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <div class="stat-card text-center p-4 bg-white rounded-4 shadow-sm stat-hover">
            <div class="stat-icon mb-3">
              <i class="bi bi-camera text-primary" style="font-size: 3rem;"></i>
            </div>
            <h3 class="counter fw-bold text-primary" data-target="500">0</h3>
            <p class="mb-0 text-muted">Dokumentasi Kegiatan</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-card text-center p-4 bg-white rounded-4 shadow-sm stat-hover">
            <div class="stat-icon mb-3">
              <i class="bi bi-trophy text-warning" style="font-size: 3rem;"></i>
            </div>
            <h3 class="counter fw-bold text-warning" data-target="50">0</h3>
            <p class="mb-0 text-muted">Prestasi Kompetisi</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-card text-center p-4 bg-white rounded-4 shadow-sm stat-hover">
            <div class="stat-icon mb-3">
              <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
            </div>
            <h3 class="counter fw-bold text-success" data-target="1200">0</h3>
            <p class="mb-0 text-muted">Peserta Terdokumentasi</p>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
          <div class="stat-card text-center p-4 bg-white rounded-4 shadow-sm stat-hover">
            <div class="stat-icon mb-3">
              <i class="bi bi-calendar-event text-info" style="font-size: 3rem;"></i>
            </div>
            <h3 class="counter fw-bold text-info" data-target="100">0</h3>
            <p class="mb-0 text-muted">Event Terlaksana</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    .bg-gradient-info {
      background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
    }
    
    .gallery-image {
      height: 200px;
      object-fit: cover;
      transition: transform 0.3s ease;
      cursor: pointer;
    }
    
    .gallery-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .gallery-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .gallery-hover:hover .gallery-image {
      transform: scale(1.05);
    }
    
    .image-overlay {
      background: rgba(0,0,0,0.7);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .gallery-hover:hover .image-overlay {
      opacity: 1;
    }
    
    .filter-btn {
      transition: all 0.3s ease;
    }
    
    .filter-btn.active {
      background-color: var(--bs-primary);
      color: white;
      border-color: var(--bs-primary);
    }
    
    .stat-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .gallery-item {
      opacity: 1;
      transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .gallery-item.hidden {
      opacity: 0;
      transform: scale(0.8);
      pointer-events: none;
    }
    
    @media (max-width: 768px) {
      .gallery-stats {
        flex-direction: column;
        gap: 1rem !important;
      }
      
      .filter-controls {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
      }
    }
  </style>

  <script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
      const filterBtns = document.querySelectorAll('.filter-btn');
      const galleryItems = document.querySelectorAll('.gallery-item');
      
      filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          // Remove active class from all buttons
          filterBtns.forEach(b => b.classList.remove('active'));
          // Add active class to clicked button
          this.classList.add('active');
          
          const filter = this.getAttribute('data-filter');
          
          galleryItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
              item.classList.remove('hidden');
            } else {
              item.classList.add('hidden');
            }
          });
        });
      });

      // Modal functionality
      const imageModal = document.getElementById('imageModal');
      const modalImage = document.getElementById('modalImage');
      const modalTitle = document.getElementById('modalTitle');
      const modalDescription = document.getElementById('modalDescription');
      
      document.querySelectorAll('.gallery-image').forEach(img => {
        img.addEventListener('click', function() {
          modalImage.src = this.getAttribute('data-image');
          modalTitle.textContent = this.getAttribute('data-title');
          modalDescription.textContent = this.getAttribute('data-description');
        });
      });

      // Counter animation
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
      
      animateCounters();

      // Load more functionality (simulation)
      const loadMoreBtn = document.getElementById('loadMoreBtn');
      loadMoreBtn.addEventListener('click', function() {
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
        
        setTimeout(() => {
          this.innerHTML = '<i class="bi bi-check-circle me-2"></i>Semua foto telah ditampilkan';
          this.classList.remove('btn-outline-primary');
          this.classList.add('btn-success');
          this.disabled = true;
        }, 2000);
      });
    });

    // Download image function
    function downloadImage() {
      const modalImage = document.getElementById('modalImage');
      const link = document.createElement('a');
      link.href = modalImage.src;
      link.download = 'CAS-Swimming-Pool-' + Date.now() + '.jpg';
      link.click();
    }

    // Share image function
    function shareImage() {
      const modalTitle = document.getElementById('modalTitle').textContent;
      const modalImage = document.getElementById('modalImage').src;
      
      if (navigator.share) {
        navigator.share({
          title: modalTitle,
          text: 'Lihat galeri kegiatan CAS Swimming Pool',
          url: window.location.href
        });
      } else {
        // Fallback to copy URL
        navigator.clipboard.writeText(window.location.href).then(() => {
          alert('Link telah disalin ke clipboard!');
        });
      }
    }
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</x-layout>