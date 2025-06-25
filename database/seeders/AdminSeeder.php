<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'nama_lengkap' => 'Administrator',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jakarta',
            'no_telp' => '08123456789',
            'asal_sekolah' => 'CAS Swimming Pool',
            'email' => 'admin@casswimmingpool.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);
    }
}
