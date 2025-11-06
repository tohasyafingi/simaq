<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KaryaIlmiah;

class KaryaIlmiahSeeder extends Seeder
{
    public function run()
    {
        KaryaIlmiah::create([
            'judul' => 'Penelitian tentang Efek Positif Olahraga terhadap Kesehatan Mental Siswa',
            'author' => 'Siti Aisyah',
            'slug' => 'penelitian-olahraga-kesehatan-mental',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 4, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        KaryaIlmiah::create([
            'judul' => 'Proyek Inovasi Sistem Penerimaan Siswa Baru berbasis Online',
            'author' => 'Rudi Kurniawan',
            'slug' => 'sistem-penerimaan-siswa-baru-online',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 2, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        KaryaIlmiah::create([
            'judul' => 'Studi Pengaruh Penggunaan Teknologi terhadap Pembelajaran Siswa',
            'author' => 'Andi Saputra',
            'slug' => 'pengaruh-teknologi-pembelajaran',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 3, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        KaryaIlmiah::create([
            'judul' => 'Inovasi Alat Penghemat Energi Listrik',
            'author' => 'Diana Putri',
            'slug' => 'inovasi-alat-penghemat-energi',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 2, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        KaryaIlmiah::create([
            'judul' => 'Kajian Terhadap Penggunaan Media Sosial dalam Pembelajaran Siswa',
            'author' => 'Budi Santoso',
            'slug' => 'penggunaan-media-sosial-pembelajaran',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 3, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
        KaryaIlmiah::create([
            'judul' => 'Pemanfaatan Teknologi Augmented Reality dalam Pembelajaran Sejarah',
            'author' => 'Rina Dwi',
            'slug' => 'pemanfaatan-ar-pembelajaran-sejarah',
            'thumbnail' => 'assets/karya.webp',
            'kat_karya_ilmiah_id' => 2, 
            'status' => 1,
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',
        ]);
    }
}

