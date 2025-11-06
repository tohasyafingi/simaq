<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        Berita::create([
            'judul' => 'Pembukaan OSIS 2025',
            'slug' => 'pembukaan-osis-2025',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 1,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        Berita::create([
            'judul' => 'Kunjungan ke Universitas ABC',
            'slug' => 'kunjungan-ke-universitas-abc',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 2,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        Berita::create([
            'judul' => 'Pemenang Lomba Matematika 2025',
            'slug' => 'pemenang-lomba-matematika-2025',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 3,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        Berita::create([
            'judul' => 'Pentas Seni SMA XYZ 2025',
            'slug' => 'pentas-seni-sma-xyz-2025',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 4,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        Berita::create([
            'judul' => 'Sosialisasi Daur Ulang Sampah',
            'slug' => 'sosialisasi-daur-ulang-sampah',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 2,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        Berita::create([
            'judul' => 'Hari Pendidikan Nasional 2025',
            'slug' => 'hari-pendidikan-nasional-2025',
            'thumbnail' => 'assets/berita.webp',
            'kat_berita_id' => 1,
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
    }
}
