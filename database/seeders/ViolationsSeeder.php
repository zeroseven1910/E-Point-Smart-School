<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ViolationsAndAchievement;

class ViolationsSeeder extends Seeder
{
    public function run(): void
    {
        $violations = [
            // Pelanggaran Ringan (5-10 poin)
            ['type' => 'pelanggaran', 'description' => 'Terlambat masuk sekolah (1-15 menit)', 'point' => 5],
            ['type' => 'pelanggaran', 'description' => 'Tidak menggunakan seragam lengkap', 'point' => 5],
            ['type' => 'pelanggaran', 'description' => 'Tidak membawa buku pelajaran', 'point' => 5],
            ['type' => 'pelanggaran', 'description' => 'Tidak mengerjakan tugas', 'point' => 8],
            ['type' => 'pelanggaran', 'description' => 'Menggunakan HP saat pelajaran', 'point' => 10],
            
            // Pelanggaran Sedang (15-25 poin)
            ['type' => 'pelanggaran', 'description' => 'Terlambat masuk sekolah (lebih dari 15 menit)', 'point' => 15],
            ['type' => 'pelanggaran', 'description' => 'Tidak masuk tanpa keterangan (Alpha)', 'point' => 15],
            ['type' => 'pelanggaran', 'description' => 'Keluar kelas tanpa izin', 'point' => 15],
            ['type' => 'pelanggaran', 'description' => 'Membuat keributan di kelas', 'point' => 20],
            ['type' => 'pelanggaran', 'description' => 'Tidak memakai atribut sekolah lengkap', 'point' => 20],
            ['type' => 'pelanggaran', 'description' => 'Merokok di lingkungan sekolah', 'point' => 25],
            
            // Pelanggaran Berat (30-50 poin)
            ['type' => 'pelanggaran', 'description' => 'Berkelahi dengan teman', 'point' => 30],
            ['type' => 'pelanggaran', 'description' => 'Membawa barang terlarang', 'point' => 35],
            ['type' => 'pelanggaran', 'description' => 'Merusak fasilitas sekolah', 'point' => 40],
            ['type' => 'pelanggaran', 'description' => 'Tidak sopan kepada guru', 'point' => 40],
            ['type' => 'pelanggaran', 'description' => 'Mencuri barang milik sekolah/teman', 'point' => 50],
            
            // Prestasi (mengurangi poin)
            ['type' => 'prestasi', 'description' => 'Juara 1 lomba tingkat sekolah', 'point' => 20],
            ['type' => 'prestasi', 'description' => 'Juara 2 lomba tingkat sekolah', 'point' => 15],
            ['type' => 'prestasi', 'description' => 'Juara 3 lomba tingkat sekolah', 'point' => 10],
            ['type' => 'prestasi', 'description' => 'Juara 1 lomba tingkat kabupaten', 'point' => 30],
            ['type' => 'prestasi', 'description' => 'Juara 2 lomba tingkat kabupaten', 'point' => 25],
            ['type' => 'prestasi', 'description' => 'Juara 3 lomba tingkat kabupaten', 'point' => 20],
            ['type' => 'prestasi', 'description' => 'Juara 1 lomba tingkat provinsi', 'point' => 50],
            ['type' => 'prestasi', 'description' => 'Menjadi ketua OSIS/MPK', 'point' => 25],
            ['type' => 'prestasi', 'description' => 'Aktif dalam kegiatan ekstrakurikuler', 'point' => 10],
            ['type' => 'prestasi', 'description' => 'Membantu kegiatan sekolah', 'point' => 5],
        ];

        foreach ($violations as $violation) {
            ViolationsAndAchievement::create($violation);
        }
    }
}