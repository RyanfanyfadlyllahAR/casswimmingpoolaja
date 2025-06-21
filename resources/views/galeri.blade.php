<x-layout>
   <x-slot:title>{{$title}}</x-slot:title>
  <style>
    .card-img-top {
      height: 180px; /* Atur tinggi gambar (rendah agar lebih "lanskap") */
      object-fit: cover; /* Biar proporsinya rapi */
      border-radius: 0.5rem;
    }
  </style>

  <div class="container py-2">
    <h1 class="text-center mb-4">Galeri Kegiatan Renang</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach ([
        '3.jpg', '8.jpg', '4.jpg', '5.jpg',
        '6.jpg', '7.jpg', 'r.jpg', 'yu.jpg'
      ] as $img)
      <div class="col">
        <div class="card h-100 border-0 shadow-sm">
          <img src="{{ asset('img/' . $img) }}" class="card-img-top" alt="Galeri Renang">
        </div>
      </div>
      @endforeach
    </div>
  </div>
</x-layout>
