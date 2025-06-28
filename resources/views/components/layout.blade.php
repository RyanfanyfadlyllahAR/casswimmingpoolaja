<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CAS SWIMMING POOL | {{ $title }}</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logo csp.jpg') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo csp.jpg') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo csp.jpg') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo csp.jpg') }}">
  
  <!-- Meta Tags for SEO -->
  <meta name="description" content="CAS Swimming Pool - Kursus renang terbaik di Pandeglang, Banten dengan instruktur berpengalaman dan fasilitas modern">
  <meta name="keywords" content="kursus renang, les renang, swimming pool, Pandeglang, Banten, instruktur renang">
  <meta name="author" content="CAS Swimming Pool">
  
  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="CAS SWIMMING POOL | {{ $title }}">
  <meta property="og:description" content="Kursus renang terbaik di Pandeglang dengan instruktur berpengalaman">
  <meta property="og:image" content="{{ asset('img/logo csp.jpg') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  
  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="CAS SWIMMING POOL | {{ $title }}">
  <meta name="twitter:description" content="Kursus renang terbaik di Pandeglang dengan instruktur berpengalaman">
  <meta name="twitter:image" content="{{ asset('img/logo csp.jpg') }}">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* Global Styles */
    body {
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
    }
    
    .carousel-item img {
      max-height: 700px;
      object-fit: cover;
    }
    
    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }
    
    /* Z-INDEX FIX */
    .navbar {
      z-index: 1020 !important;
    }
    
    .page-loader {
      z-index: 9999 !important;
    }
    
    .back-to-top {
      z-index: 1000 !important;
    }
    
    .whatsapp-float {
      z-index: 1000 !important;
    }
    
    .carousel {
      z-index: 1 !important;
    }
    
    .dropdown-menu {
      z-index: 1025 !important;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #007bff, #0056b3);
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, #0056b3, #004085);
    }
    
    /* Loading animation */
    .page-loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #007bff, #0056b3);
      display: flex;
      justify-content: center;
      align-items: center;
      transition: opacity 0.5s ease;
    }
    
    .loader-spinner {
      width: 50px;
      height: 50px;
      border: 5px solid rgba(255,255,255,0.3);
      border-top: 5px solid white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .loader-text {
      color: white;
      margin-left: 20px;
      font-weight: 600;
    }
    
    /* Fade in animation for content */
    /* .content-wrapper {
      opacity: 0;
      animation: fadeIn 0.5s forwards;
      animation-delay: 0.5s;
    } */
    
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    /* Back to top button */
    .back-to-top {
      position: fixed;
      bottom: 80px;
      right: 20px;
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(0,123,255,0.3);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    
    .back-to-top.show {
      opacity: 1;
      visibility: visible;
    }
    
    .back-to-top:hover {
      background: linear-gradient(135deg, #0056b3, #004085);
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,123,255,0.4);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .back-to-top {
        bottom: 90px;
        right: 15px;
        width: 45px;
        height: 45px;
      }
    }
  </style>

  <!-- Schema.org Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SportsActivityLocation",
    "name": "CAS Swimming Pool",
    "description": "Kursus renang profesional dengan instruktur berpengalaman di Pandeglang, Banten",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('img/logo csp.jpg') }}",
    "image": "{{ asset('img/logo csp.jpg') }}",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Pandeglang",
      "addressRegion": "Banten",
      "addressCountry": "ID"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "-6.2088",
      "longitude": "106.8456"
    },
    "telephone": "0812-3456-7890",
    "email": "info@casswimmingpool.com",
    "openingHours": "Mo-Su 06:00-21:00",
    "priceRange": "$$",
    "sameAs": [
      "https://instagram.com/cspprivaterenang",
      "https://wa.me/6281234567890"
    ]
  }
  </script>
</head>
<body>
  <!-- Page Loader -->
  <div class="page-loader" id="pageLoader">
    <div class="loader-spinner"></div>
    <div class="loader-text">Loading...</div>
  </div>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Konten Halaman -->
    {{ $slot }}
    
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop" title="Kembali ke atas">
      <i class="bi bi-arrow-up"></i>
    </a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
    // Page loader
    window.addEventListener('load', function() {
      const loader = document.getElementById('pageLoader');
      setTimeout(() => {
        loader.style.opacity = '0';
        setTimeout(() => {
          loader.style.display = 'none';
        }, 500);
      }, 1000);
    });

    // Back to top button
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add('show');
      } else {
        backToTopButton.classList.remove('show');
      }
    });
    
    backToTopButton.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Smooth scrolling for anchor links
    document.addEventListener('DOMContentLoaded', function() {
      const links = document.querySelectorAll('a[href^="#"]');
      links.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            const headerOffset = 80;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
            
            window.scrollTo({
              top: offsetPosition,
              behavior: 'smooth'
            });
          }
        });
      });
    });

    // Console welcome message
    console.log('%c🏊‍♂️ Selamat datang di CAS Swimming Pool! 🏊‍♀️', 'color: #007bff; font-size: 16px; font-weight: bold;');
    console.log('%cKursus renang terbaik di Pandeglang, Banten', 'color: #6c757d; font-size: 12px;');
  </script>
</body>
</html>