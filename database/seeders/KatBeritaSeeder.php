<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KatBerita;

class KatBeritaSeeder extends Seeder
{
    public function run()
    {
        KatBerita::create(['nama' => 'Berita Sekolah', 'slug' => 'berita-sekolah']);
        KatBerita::create(['nama' => 'Kegiatan Siswa', 'slug' => 'kegiatan-siswa']);
        KatBerita::create(['nama' => 'Prestasi Sekolah', 'slug' => 'prestasi-sekolah']);
        KatBerita::create(['nama' => 'Kegiatan Ekstrakurikuler', 'slug' => 'kegiatan-ekstrakurikuler']);
    }
}
