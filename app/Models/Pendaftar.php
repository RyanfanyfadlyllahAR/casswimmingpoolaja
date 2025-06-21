<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 'pendaftar';
    
    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telepon', 
        'paket_dipilih',
        'status_pendaftaran'
    ];
}
