<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal_Kursus extends Model
{
    protected $table = 'jadwal_kursus';
    
    protected $fillable = [
        'kursus_id',
        'instruktur_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kapasitas_maksimal',
        'status',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    // Relasi dengan kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    // Relasi dengan instruktur
    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class, 'instruktur_id');
    }

    // Relasi dengan peserta yang memilih jadwal ini
    public function pesertas()
    {
        return $this->hasMany(Peserta::class, 'jadwal_id');
    }

    // Scope untuk jadwal aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Method untuk cek kapasitas tersedia
    public function kapasitasTersedia()
    {
        return $this->kapasitas_maksimal - $this->pesertas()->count();
    }
}