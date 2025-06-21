<x-layout>
   <x-slot:title>{{$title}}</x-slot:title>
  <!-- Carousel tanpa id dan tombol -->
<div class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/atlite.jpg" class="d-block w-100" alt="Renang 1">
    </div>
    <div class="carousel-item">
      <img src="img/a.jpg" class="d-block w-100" alt="Renang 2">
    </div>
    <div class="carousel-item">
      <img src="img/b.jpg" class="d-block w-100" alt="Renang 3">
    </div>
  </div>
</x-layout>
