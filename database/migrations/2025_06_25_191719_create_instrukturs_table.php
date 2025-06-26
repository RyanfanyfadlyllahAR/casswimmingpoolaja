<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instrukturs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instruktur');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('no_telp');
            $table->text('keahlian');
            $table->string('sertifikat')->nullable();
            $table->integer('pengalaman'); // dalam tahun
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrukturs');
    }
};