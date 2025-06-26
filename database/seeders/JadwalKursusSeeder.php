<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal_Kursus;
use App\Models\Kursus;
use App\Models\Instruktur;

class JadwalKursusSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan data kursus dan instruktur ada
        $kursus = Kursus::all();
        $instrukturs = Instruktur::all();

        if ($kursus->count() == 0) {
            $this->command->warn('Tidak ada data kursus. Jalankan KursusSeeder terlebih dahulu.');
            return;
        }

        if ($instrukturs->count() == 0) {
            $this->command->warn('Tidak ada data instruktur. Jalankan InstrukturSeeder terlebih dahulu.');
            return;
        }

        // Ambil ID yang valid dari database
        $kursusIds = $kursus->pluck('id')->toArray();
        $instrukturIds = $instrukturs->pluck('id')->toArray();

        // Buat array jadwal dengan ID yang valid
        $jadwals = [];

        // Cek apakah ada minimal 5 kursus dan 4 instruktur
        if (count($kursusIds) >= 5 && count($instrukturIds) >= 4) {
            $jadwals = [
                // Kursus Renang Pemula
                [
                    'kursus_id' => $kursusIds[0], // Kursus pertama
                    'instruktur_id' => $instrukturIds[1], // Instruktur kedua
                    'hari' => 'Senin',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '09:30',
                    'kapasitas_maksimal' => 8,
                    'status' => 'aktif',
                ],
                [
                    'kursus_id' => $kursusIds[0],
                    'instruktur_id' => $instrukturIds[1],
                    'hari' => 'Rabu',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '09:30',
                    'kapasitas_maksimal' => 8,
                    'status' => 'aktif',
                ],
                // Kursus Renang Menengah
                [
                    'kursus_id' => $kursusIds[1], // Kursus kedua
                    'instruktur_id' => $instrukturIds[0], // Instruktur pertama
                    'hari' => 'Selasa',
                    'jam_mulai' => '10:00',
                    'jam_selesai' => '11:30',
                    'kapasitas_maksimal' => 10,
                    'status' => 'aktif',
                ],
                [
                    'kursus_id' => $kursusIds[1],
                    'instruktur_id' => $instrukturIds[0],
                    'hari' => 'Kamis',
                    'jam_mulai' => '10:00',
                    'jam_selesai' => '11:30',
                    'kapasitas_maksimal' => 10,
                    'status' => 'aktif',
                ],
                // Kursus Renang Lanjutan
                [
                    'kursus_id' => $kursusIds[2], // Kursus ketiga
                    'instruktur_id' => $instrukturIds[2], // Instruktur ketiga
                    'hari' => 'Jumat',
                    'jam_mulai' => '16:00',
                    'jam_selesai' => '17:30',
                    'kapasitas_maksimal' => 6,
                    'status' => 'aktif',
                ],
                [
                    'kursus_id' => $kursusIds[2],
                    'instruktur_id' => $instrukturIds[2],
                    'hari' => 'Sabtu',
                    'jam_mulai' => '16:00',
                    'jam_selesai' => '17:30',
                    'kapasitas_maksimal' => 6,
                    'status' => 'aktif',
                ],
                // Kursus Renang Anak
                [
                    'kursus_id' => $kursusIds[3], // Kursus keempat
                    'instruktur_id' => $instrukturIds[1],
                    'hari' => 'Sabtu',
                    'jam_mulai' => '09:00',
                    'jam_selesai' => '10:00',
                    'kapasitas_maksimal' => 6,
                    'status' => 'aktif',
                ],
                [
                    'kursus_id' => $kursusIds[3],
                    'instruktur_id' => $instrukturIds[1],
                    'hari' => 'Minggu',
                    'jam_mulai' => '09:00',
                    'jam_selesai' => '10:00',
                    'kapasitas_maksimal' => 6,
                    'status' => 'aktif',
                ],
                // Kursus Renang Private
                [
                    'kursus_id' => $kursusIds[4], // Kursus kelima
                    'instruktur_id' => $instrukturIds[3], // Instruktur keempat
                    'hari' => 'Senin',
                    'jam_mulai' => '14:00',
                    'jam_selesai' => '15:00',
                    'kapasitas_maksimal' => 1,
                    'status' => 'aktif',
                ],
                [
                    'kursus_id' => $kursusIds[4],
                    'instruktur_id' => $instrukturIds[3],
                    'hari' => 'Rabu',
                    'jam_mulai' => '14:00',
                    'jam_selesai' => '15:00',
                    'kapasitas_maksimal' => 1,
                    'status' => 'aktif',
                ],
            ];
        } else {
            // Jika data tidak cukup, buat jadwal sederhana dengan data yang ada
            for ($i = 0; $i < min(count($kursusIds), count($instrukturIds)); $i++) {
                $jadwals[] = [
                    'kursus_id' => $kursusIds[$i],
                    'instruktur_id' => $instrukturIds[$i],
                    'hari' => 'Senin',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '09:00',
                    'kapasitas_maksimal' => 8,
                    'status' => 'aktif',
                ];
            }
        }

        // Insert data jadwal
        foreach ($jadwals as $data) {
            try {
                Jadwal_Kursus::create($data);
            } catch (\Exception $e) {
                $this->command->error("Error creating jadwal: " . $e->getMessage());
            }
        }

        $this->command->info('JadwalKursusSeeder berhasil dijalankan dengan ' . count($jadwals) . ' jadwal.');
    }
}