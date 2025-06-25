<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursus;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kursus = [
            [
                'nama_kursus' => 'Kursus Renang Pemula',
                'deskripsi' => 'Kursus renang untuk pemula yang belum bisa berenang. Materi meliputi teknik dasar, pernapasan, dan keselamatan di air.',
                'durasi' => '8 Pertemuan',
                'biaya' => 500000,
                'tanggal_mulai' => '2024-07-01',
                'tanggal_selesai' => '2024-07-31',
                'status' => 'aktif',
            ],
            [
                'nama_kursus' => 'Kursus Renang Menengah',
                'deskripsi' => 'Kursus untuk yang sudah bisa berenang dan ingin meningkatkan teknik gaya bebas, gaya dada, dan gaya punggung.',
                'durasi' => '10 Pertemuan',
                'biaya' => 750000,
                'tanggal_mulai' => '2024-07-15',
                'tanggal_selesai' => '2024-08-15',
                'status' => 'aktif',
            ],
            [
                'nama_kursus' => 'Kursus Renang Lanjutan',
                'deskripsi' => 'Kursus untuk perenang yang ingin menguasai teknik lanjutan dan persiapan kompetisi.',
                'durasi' => '12 Pertemuan',
                'biaya' => 1000000,
                'tanggal_mulai' => '2024-08-01',
                'tanggal_selesai' => '2024-09-01',
                'status' => 'aktif',
            ],
        ];

        foreach ($kursus as $data) {
            Kursus::create($data);
        }
    }
}
