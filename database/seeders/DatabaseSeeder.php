<?php

namespace Database\Seeders;

use App\Models\KatBerita;
use App\Models\KatKaryaIlmiah;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder ::class,
            TahunAjaranSeeder::class,
            TingkatKelasSeeder::class,
            JurusanSeeder::class,
            RuangKelasSeeder::class,
            PelajaranSeeder::class,
            ModulSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            BendaharaSeeder::class,
            TataUsahaSeeder::class,
            // KatBeritaSeeder::class,
            // KatKaryaIlmiahSeeder::class,
            // BeritaSeeder::class,
            // KaryaIlmiahSeeder::class,
        ]);
    }
}