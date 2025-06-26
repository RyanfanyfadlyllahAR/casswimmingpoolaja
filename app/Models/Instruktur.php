<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal_Kursus;


class Instruktur extends Model
{
    protected $table = 'instrukturs';
    
    protected $fillable = [
        'nama_instruktur',
        'jenis_kelamin',
        'no_telp',
        'keahlian',
        'sertifikat',
        'pengalaman',
        'status',
    ];

    // Relasi dengan jadwal kursus
    public function Jadwal_Kursus()
    {
        return $this->hasMany(Jadwal_Kursus::class, 'instruktur_id');
    }

    // Scope untuk instruktur aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
