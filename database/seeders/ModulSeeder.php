<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ModulSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $pelajaranIds = DB::table('pelajarans')->pluck('id');

        for ($i = 0; $i < 50; $i++) {
            DB::table('moduls')->insert([
                'nama' => 'Modul ' . ($i + 1) . ': ' . $faker->sentence(3),
                'pelajaran_id' => $faker->randomElement($pelajaranIds),
                'link' => $faker->url,
                'file' => null, // Nullable, bisa diisi path file dummy
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}