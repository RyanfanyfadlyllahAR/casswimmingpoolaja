<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruktur;

class InstrukturSeeder extends Seeder
{
    public function run(): void
    {
        $instrukturs = [
            [
                'nama_instruktur' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'no_telp' => '081234567890',
                'keahlian' => 'Spesialisasi gaya bebas dan gaya kupu-kupu. Berpengalaman mengajar pemula hingga atlet profesional. Menguasai teknik pernapasan dan diving.',
                'sertifikat' => 'Sertifikat Pelatih Renang Nasional Level A',
                'pengalaman' => 8,
                'status' => 'aktif',
            ],
            [
                'nama_instruktur' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'no_telp' => '082345678901',
                'keahlian' => 'Spesialisasi gaya dada dan gaya punggung. Ahli dalam mengajar anak-anak dan terapi renang untuk pemulihan cedera.',
                'sertifikat' => 'Sertifikat Pelatih Renang & Water Safety',
                'pengalaman' => 5,
                'status' => 'aktif',
            ],
            [
                'nama_instruktur' => 'Ahmad Riadi',
                'jenis_kelamin' => 'Laki-laki',
                'no_telp' => '083456789012',
                'keahlian' => 'Spesialisasi semua gaya renang dan pelatihan intensif. Berpengalaman sebagai pelatih klub renang dan persiapan kompetisi.',
                'sertifikat' => 'Sertifikat Pelatih Renang Internasional',
                'pengalaman' => 12,
                'status' => 'aktif',
            ],
            [
                'nama_instruktur' => 'Maya Sari',
                'jenis_kelamin' => 'Perempuan',
                'no_telp' => '084567890123',
                'keahlian' => 'Spesialisasi aqua fitness dan renang untuk dewasa. Menguasai teknik relaksasi di air dan water aerobic.',
                'sertifikat' => 'Sertifikat Aqua Fitness Instructor',
                'pengalaman' => 4,
                'status' => 'aktif',
            ],
        ];

        foreach ($instrukturs as $data) {
            Instruktur::create($data);
        }
    }
}