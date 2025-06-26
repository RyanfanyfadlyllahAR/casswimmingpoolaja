<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Hero Section -->
    <section class="hero-contact py-5 bg-gradient-success text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">
                        Hubungi Kami
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Kami siap membantu Anda memulai perjalanan renang yang menakjubkan
                    </p>
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#contact-info" class="btn btn-light btn-lg">
                            <i class="bi bi-arrow-down"></i> Mulai Berkomunikasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact Cards -->
    <section id="contact-info" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Cara Menghubungi Kami</h2>
                <p class="lead text-muted">Pilih metode komunikasi yang paling nyaman untuk Anda</p>
            </div>

            <div class="row g-4 mb-5">
                <!-- WhatsApp Card -->
                <div class="col-lg-6 mb-4">
                    <div class="contact-card card h-100 shadow-lg border-0">
                        <div class="card-body p-4 text-center">
                            <div class="contact-icon mb-4">
                                <div class="icon-circle bg-success text-white d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px;">
                                    <i class="bi bi-whatsapp" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h4 class="text-success mb-3">WhatsApp</h4>
                            <p class="text-muted mb-4">
                                Chat langsung dengan tim kami untuk konsultasi gratis dan informasi program kursus
                            </p>
                            <div class="contact-details mb-4">
                                <h5 class="text-dark">0812-3456-7890</h5>
                                <small class="text-muted">Tersedia 24/7</small>
                            </div>
                            <div class="contact-actions">
                                <a href="https://wa.me/6281234567890?text=Halo%20CAS%20Swimming%20Pool,%20saya%20ingin%20bertanya%20tentang%20program%20kursus%20renang" 
                                   target="_blank" 
                                   class="btn btn-success btn-lg">
                                    <i class="bi bi-whatsapp me-2"></i>
                                    Chat Sekarang
                                </a>
                            </div>
                            <div class="features mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-check-circle text-success me-1"></i> Respon Cepat
                                    <i class="bi bi-check-circle text-success me-1 ms-2"></i> Konsultasi Gratis
                                    <i class="bi bi-check-circle text-success me-1 ms-2"></i> Daftar Online
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instagram Card -->
                <div class="col-lg-6 mb-4">
                    <div class="contact-card card h-100 shadow-lg border-0">
                        <div class="card-body p-4 text-center">
                            <div class="contact-icon mb-4">
                                <div class="icon-circle bg-gradient-instagram text-white d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px;">
                                    <i class="bi bi-instagram" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h4 class="text-primary mb-3">Instagram</h4>
                            <p class="text-muted mb-4">
                                Follow akun Instagram kami untuk melihat aktivitas terbaru, tips renang, dan galeri foto
                            </p>
                            <div class="contact-details mb-4">
                                <h5 class="text-dark">@cspprivaterenang</h5>
                                <small class="text-muted">Update harian</small>
                            </div>
                            <div class="contact-actions">
                                <a href="https://instagram.com/cspprivaterenang" 
                                   target="_blank" 
                                   class="btn btn-gradient-instagram btn-lg">
                                    <i class="bi bi-instagram me-2"></i>
                                    Follow Instagram
                                </a>
                            </div>
                            <div class="features mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-check-circle text-primary me-1"></i> Galeri Foto
                                    <i class="bi bi-check-circle text-primary me-1 ms-2"></i> Tips Harian
                                    <i class="bi bi-check-circle text-primary me-1 ms-2"></i> Live Update
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information Detail -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="contact-info-card card shadow border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-info-circle me-2"></i>
                                Informasi Lengkap
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="info-item p-3 bg-light rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-geo-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <p class="text-muted mb-0 ms-4">
                                            Pandeglang, Banten<br>
                                            <small>Lokasi strategis dan mudah dijangkau</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-item p-3 bg-light rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-clock text-success me-3" style="font-size: 1.5rem;"></i>
                                            <h6 class="mb-0">Jam Operasional</h6>
                                        </div>
                                        <p class="text-muted mb-0 ms-4">
                                            Senin - Minggu<br>
                                            <small>06:00 - 21:00 WIB</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-item p-3 bg-light rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-envelope text-warning me-3" style="font-size: 1.5rem;"></i>
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <p class="text-muted mb-0 ms-4">
                                            info@casswimmingpool.com<br>
                                            <small>Untuk pertanyaan resmi</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-item p-3 bg-light rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-telephone text-info me-3" style="font-size: 1.5rem;"></i>
                                            <h6 class="mb-0">Telepon</h6>
                                        </div>
                                        <p class="text-muted mb-0 ms-4">
                                            0812-3456-7890<br>
                                            <small>Customer Service</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Pertanyaan Yang Sering Diajukan</h2>
                <p class="lead text-muted">Temukan jawaban atas pertanyaan umum seputar kursus renang</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="bi bi-question-circle text-primary me-2"></i>
                                    Bagaimana cara mendaftar kursus renang?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda bisa mendaftar melalui WhatsApp, datang langsung ke lokasi, atau melalui website kami. Tim kami akan membantu Anda memilih program yang sesuai dengan level kemampuan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="bi bi-question-circle text-primary me-2"></i>
                                    Apakah ada trial class gratis?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya! Kami menyediakan trial class gratis untuk peserta baru. Hubungi kami untuk mengatur jadwal trial yang sesuai dengan Anda.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="bi bi-question-circle text-primary me-2"></i>
                                    Berapa lama waktu yang dibutuhkan untuk bisa berenang?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Waktu pembelajaran berbeda untuk setiap individu. Rata-rata untuk pemula bisa berenang dasar dalam 8-12 pertemuan dengan latihan 2x seminggu.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="bi bi-question-circle text-primary me-2"></i>
                                    Apakah tersedia peralatan renang?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, kami menyediakan peralatan latihan seperti papan pelampung, pull buoy, dan alat bantu lainnya. Anda hanya perlu membawa baju renang dan handuk.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-gradient-success text-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3">Siap Memulai Perjalanan Renang Anda?</h2>
            <p class="lead mb-4">Jangan ragu untuk menghubungi kami. Tim profesional kami siap membantu Anda!</p>
            <div class="cta-buttons">
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-light btn-lg me-3 mb-3">
                    <i class="bi bi-whatsapp me-2"></i>
                    Chat WhatsApp
                </a>
                <a href="/kursus" class="btn btn-outline-light btn-lg mb-3">
                    <i class="bi bi-water me-2"></i>
                    Lihat Program
                </a>
            </div>
            <div class="mt-4">
                <small class="opacity-75">
                    <i class="bi bi-shield-check me-1"></i>
                    Konsultasi gratis • Respon cepat • Pelayanan profesional
                </small>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
    <style>
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        
        .bg-gradient-instagram {
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        }
        
        .btn-gradient-instagram {
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
            border: none;
            color: white;
        }
        
        .btn-gradient-instagram:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
        
        .contact-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
        
        .icon-circle {
            transition: transform 0.3s ease;
        }
        
        .contact-card:hover .icon-circle {
            transform: scale(1.1);
        }
        
        .info-item {
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            background-color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .accordion-button {
            background-color: #f8f9fa;
            border: none;
        }
        
        .accordion-button:not(.collapsed) {
            background-color: #007bff;
            color: white;
        }
        
        .accordion-button:focus {
            box-shadow: none;
        }
        
        .cta-buttons .btn {
            min-width: 180px;
            transition: transform 0.3s ease;
        }
        
        .cta-buttons .btn:hover {
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2rem;
            }
            
            .display-5 {
                font-size: 1.8rem;
            }
            
            .icon-circle {
                width: 60px !important;
                height: 60px !important;
            }
            
            .icon-circle i {
                font-size: 2rem !important;
            }
            
            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
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
        
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.contact-card, .info-item');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(card);
            });
        });
        
        // WhatsApp button click tracking
        document.addEventListener('click', function(e) {
            if (e.target.closest('a[href*="wa.me"]')) {
                // Add animation to button
                const button = e.target.closest('a');
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = '';
                }, 150);
            }
        });
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</x-layout>