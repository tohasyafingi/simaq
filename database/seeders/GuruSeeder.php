<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Bahasa Indonesia

        for ($i = 0; $i < 25; $i++) {
            DB::table('gurus')->insert([
                'kd_guru' => 'GUR' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'no_hp' => $faker->phoneNumber,
                'img' => null, // Nullable, bisa diisi path gambar dummy jika perlu
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}