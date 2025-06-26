<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{

    protected $table = 'kursus';
    protected $fillable = [
        'nama_kursus',
        'deskripsi',
        'durasi',
        'biaya',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'biaya' => 'decimal:2',
    ];

    // Relasi dengan peserta
    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'kursus_id');
    }

    // Relasi dengan jadwal kursus
    public function Jadwal_Kursus()
    {
        return $this->hasMany(Jadwal_Kursus::class, 'kursus_id');
    }

    // Scope untuk kursus aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
