<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
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
        ]);
    }
}