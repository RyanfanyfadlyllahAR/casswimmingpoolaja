<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'kursus_id',
        'user_id',
        'jadwal_id',
        'status',
        'tanggal_daftar',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    // Relasi dengan jadwal kursus
    public function jadwal()
    {
        return $this->belongsTo(Jadwal_Kursus::class, 'jadwal_id');
    }
}
