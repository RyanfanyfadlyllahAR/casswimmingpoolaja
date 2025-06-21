<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="container py-4">
    <h1 class="text-center mb-4">Informasi Kursus Renang CAS Swimming Pool</h1>

    <article class="mb-5 border rounded p-3 shadow-sm bg-white">
      <div class="row align-items-center">
        <div class="col-md-6">
          <a href="/informasis/{{ $informasi['id'] }}">
            <img src="{{ asset('img/' . $informasi['img']) }}"
                 class="img-fluid rounded shadow-sm w-100"
                 style="aspect-ratio: 16/9; object-fit: cover;"
                 alt="{{ $informasi['title'] }}">
          </a>
        </div>
        <div class="col-md-6 px-md-3">
          <h2 class="h5 mb-2">{{ $informasi['title'] }}</h2>
          <p class="my-4 font-light">{{ $informasi['body'] }}</p>
          <a href="/informasis" class="text-decoration-none text-dark small"
             onmouseover="this.classList.add('text-primary', 'text-decoration-underline')"
             onmouseout="this.classList.remove('text-primary', 'text-decoration-underline')">
             &laquo; Kembali
          </a>
        </div>
      </div>
    </article>
  </div>
</x-layout>
