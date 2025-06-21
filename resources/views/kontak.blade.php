<x-layout>
     <x-slot:title>{{$title}}</x-slot:title>
    <!-- Konten Halaman Kontak -->
  <div class="container py-2">
    <h1 class="text-center mb-4">Kontak Kami</h1>

    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <p class="lead">Hubungi kami melalui media sosial berikut:</p>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="https://instagram.com/cspprivaterenang" target="_blank" class="btn btn-outline-primary">
              <i class="bi bi-instagram"></i> Instagram: @cspprivaterenang
            </a>
          </li>
          <!-- Tambahkan kontak lain jika ada, contoh WhatsApp -->
          <li class="mb-2">
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-success">
              <i class="bi bi-whatsapp"></i> WhatsApp: 0812-3456-7890
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</x-layout>