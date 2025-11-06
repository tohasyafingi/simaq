<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KatKaryaIlmiah;

class KatKaryaIlmiahSeeder extends Seeder
{
    public function run()
    {
        KatKaryaIlmiah::create(['nama' => 'Penelitian Siswa', 'slug' => 'penelitian-siswa']);
        KatKaryaIlmiah::create(['nama' => 'Proyek Inovasi', 'slug' => 'proyek-inovasi']);
    }
}

