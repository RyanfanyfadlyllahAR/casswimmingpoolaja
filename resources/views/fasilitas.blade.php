<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="hero-facilities py-5 bg-gradient-info text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">
                        Fasilitas Kelas Dunia
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Nikmati pengalaman belajar renang dengan fasilitas modern dan peralatan berkualitas tinggi
                    </p>
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#facilities" class="btn btn-light btn-lg">
                            <i class="bi bi-arrow-down"></i> Jelajahi Fasilitas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Facilities Section -->
    <section id="facilities" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Fasilitas Utama</h2>
                <p class="lead text-muted">Fasilitas lengkap untuk mendukung pembelajaran renang yang optimal</p>
            </div>

            <div class="row g-4">
                <!-- Kolam Renang Standar -->
                <div class="col-lg-6 mb-4">
                    <div class="facility-card card h-100 shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-water display-6 me-3"></i>
                                <div>
                                    <h4 class="mb-0">Kolam Renang Standar</h4>
                                    <small class="opacity-75">Fasilitas Utama</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="facility-image mb-3">
                                <img src="{{ asset('img/atlite.jpg') }}" alt="Kolam Renang Standar" class="img-fluid rounded">
                            </div>
                            <div class="facility-details">
                                <h5 class="text-primary mb-3">Spesifikasi Kolam:</h5>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="spec-item text-center p-3 bg-light rounded">
                                            <i class="bi bi-rulers text-primary d-block mb-2" style="font-size: 1.5rem;"></i>
                                            <strong>25m x 12m</strong>
                                            <small class="d-block text-muted">Panjang x Lebar</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="spec-item text-center p-3 bg-light rounded">
                                            <i class="bi bi-arrow-down text-primary d-block mb-2" style="font-size: 1.5rem;"></i>
                                            <strong>1.2m - 3m</strong>
                                            <small class="d-block text-muted">Kedalaman</small>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle text-success me-2"></i>
                                        Kolam renang standar internasional dengan 6 lintasan
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle text-success me-2"></i>
                                        Sistem filtrasi canggih untuk menjaga kebersihan air
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle text-success me-2"></i>
                                        Kolam anak terpisah untuk peserta usia dini (kedalaman 0.8m)
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle text-success me-2"></i>
                                        Pencahayaan optimal untuk latihan malam hari
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pelatih Bersertifikat -->
                <div class="col-lg-6 mb-4">
                    <div class="facility-card card h-100 shadow-lg border-0">
                        <div class="card-header bg-success text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people display-6 me-3"></i>
                                <div>
                                    <h4 class="mb-0">Tim Pelatih Profesional</h4>
                                    <small class="opacity-75">SDM Berkualitas</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="facility-image mb-3">
                                <img src="{{ asset('img/a.jpg') }}" alt="Tim Pelatih" class="img-fluid rounded">
                            </div>
                            <div class="facility-details">
                                <h5 class="text-success mb-3">Kualifikasi Pelatih:</h5>
                                <div class="row g-3 mb-3">
                                    <div class="col-4">
                                        <div class="spec-item text-center p-2 bg-light rounded">
                                            <strong class="text-success">15+</strong>
                                            <small class="d-block text-muted">Pelatih</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="spec-item text-center p-2 bg-light rounded">
                                            <strong class="text-success">5+</strong>
                                            <small class="d-block text-muted">Tahun Exp</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="spec-item text-center p-2 bg-light rounded">
                                            <strong class="text-success">100%</strong>
                                            <small class="d-block text-muted">Bersertifikat</small>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="bi bi-award text-warning me-2"></i>
                                        Sertifikasi dari Federasi Renang Indonesia (PRSI)
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-award text-warning me-2"></i>
                                        Pelatihan P3K dan Water Safety
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-award text-warning me-2"></i>
                                        Pengalaman melatih berbagai tingkat usia
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-award text-warning me-2"></i>
                                        Update training metode terbaru
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipment Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Peralatan Latihan</h2>
                <p class="lead text-muted">Peralatan berkualitas tinggi untuk mendukung pembelajaran yang efektif</p>
            </div>

            <div class="row g-4">
                <!-- Papan Pelampung -->
                <div class="col-lg-6 mb-4">
                    <div class="equipment-card card shadow border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="equipment-image text-center">
                                        <img src="{{ asset('img/papan pelampung.jpeg') }}" alt="Papan Pelampung" class="img-fluid rounded shadow" style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="equipment-info">
                                        <h4 class="text-primary mb-3">
                                            <i class="bi bi-rectangle me-2"></i>
                                            Papan Pelampung (Kickboard)
                                        </h4>
                                        <p class="text-muted mb-3">
                                            Alat bantu renang berbentuk datar dan ringan yang membantu dalam berbagai latihan teknik kaki.
                                        </p>
                                        
                                        <div class="functions-list">
                                            <h6 class="fw-bold mb-2">Fungsi Utama:</h6>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-primary me-2"></i>
                                                <span><strong>Melatih Teknik Kaki:</strong> Fokus pada gerakan kaki sambil tangan memegang papan</span>
                                            </div>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-primary me-2"></i>
                                                <span><strong>Membantu Pemula:</strong> Menambah rasa percaya diri di air</span>
                                            </div>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-primary me-2"></i>
                                                <span><strong>Koordinasi:</strong> Fokus pada pernapasan dan teknik</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pull Buoy -->
                <div class="col-lg-6 mb-4">
                    <div class="equipment-card card shadow border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="equipment-image text-center">
                                        <img src="{{ asset('img/pull bouy.jpg') }}" alt="Pull Buoy" class="img-fluid rounded shadow" style="max-height: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="equipment-info">
                                        <h4 class="text-success mb-3">
                                            <i class="bi bi-infinity me-2"></i>
                                            Pull Buoy
                                        </h4>
                                        <p class="text-muted mb-3">
                                            Alat bantu berbentuk angka 8 yang ditempatkan di antara paha untuk melatih gerakan tangan.
                                        </p>
                                        
                                        <div class="functions-list">
                                            <h6 class="fw-bold mb-2">Fungsi Utama:</h6>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-success me-2"></i>
                                                <span><strong>Melatih Tangan:</strong> Fokus pada gerakan tangan tanpa menggunakan kaki</span>
                                            </div>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-success me-2"></i>
                                                <span><strong>Posisi Tubuh:</strong> Menjaga tubuh sejajar dengan permukaan air</span>
                                            </div>
                                            <div class="function-item mb-2">
                                                <i class="bi bi-chevron-right text-success me-2"></i>
                                                <span><strong>Kekuatan:</strong> Menguatkan otot lengan dan bahu</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Equipment -->
                <div class="col-lg-4 mb-4">
                    <div class="equipment-card card shadow border-0 h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-stopwatch text-warning display-4 mb-3"></i>
                            <h5 class="mb-3">Stopwatch Digital</h5>
                            <p class="text-muted">Untuk mengukur waktu dan monitoring progress latihan</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="equipment-card card shadow border-0 h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-life-preserver text-danger display-4 mb-3"></i>
                            <h5 class="mb-3">Peralatan Keselamatan</h5>
                            <p class="text-muted">Life ring, pelampung, dan peralatan P3K lengkap</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="equipment-card card shadow border-0 h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-thermometer text-info display-4 mb-3"></i>
                            <h5 class="mb-3">Kontrol Suhu</h5>
                            <p class="text-muted">Sistem pemanas untuk menjaga suhu air yang optimal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Facilities -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Fasilitas Pendukung</h2>
                <p class="lead text-muted">Fasilitas tambahan untuk kenyamanan Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-facility text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-door-open text-primary display-4 mb-3"></i>
                        <h5>Ruang Ganti</h5>
                        <p class="text-muted">Ruang ganti yang bersih dan nyaman dengan locker</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-facility text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cup-hot text-warning display-4 mb-3"></i>
                        <h5>Kantin</h5>
                        <p class="text-muted">Kantin dengan minuman dan makanan ringan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-facility text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-car-front text-success display-4 mb-3"></i>
                        <h5>Area Parkir</h5>
                        <p class="text-muted">Area parkir yang luas dan aman untuk kendaraan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-facility text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-wifi text-info display-4 mb-3"></i>
                        <h5>WiFi Gratis</h5>
                        <p class="text-muted">Akses internet gratis untuk seluruh area</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-gradient-primary text-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3">Siap Merasakan Fasilitas Terbaik?</h2>
            <p class="lead mb-4">Bergabunglah dengan kami dan nikmati pengalaman belajar renang dengan fasilitas kelas dunia</p>
            <div>
                <a href="/kursus" class="btn btn-light btn-lg me-3">
                    <i class="bi bi-water"></i> Lihat Program Kursus
                </a>
                <a href="/kontak" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-telephone"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        
        .facility-card, .equipment-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .facility-card:hover, .equipment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        
        .support-facility {
            transition: all 0.3s ease;
        }
        
        .support-facility:hover {
            transform: translateY(-5px);
            background-color: #f8f9fa;
        }
        
        .spec-item {
            transition: transform 0.3s ease;
        }
        
        .spec-item:hover {
            transform: scale(1.05);
        }
        
        .function-item {
            padding: 5px 0;
            border-left: 3px solid transparent;
            padding-left: 10px;
            transition: all 0.3s ease;
        }
        
        .function-item:hover {
            border-left-color: #007bff;
            background-color: rgba(0,123,255,0.05);
            margin-left: 5px;
        }
        
        .equipment-image img {
            transition: transform 0.3s ease;
        }
        
        .equipment-image:hover img {
            transform: scale(1.05);
        }
        
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2rem;
            }
            
            .display-5 {
                font-size: 1.8rem;
            }
            
            .facility-card .row {
                text-align: center;
            }
            
            .equipment-card .row {
                text-align: center;
            }
        }
    </style>

    <!-- Custom JavaScript -->
    <script>
        // Smooth scrolling
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
        
        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe all cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.facility-card, .equipment-card, .support-facility');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(card);
            });
        });
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</x-layout>