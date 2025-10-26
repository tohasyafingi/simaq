<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 125; $i++) {
            DB::table('siswas')->insert([
                'nis' => 'NIS' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'no_hp' => $faker->phoneNumber,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2008-01-01'), // Usia SMA: 15-18 tahun (lahir 2005-2008)
                'alamat' => $faker->address,
                'kk' => null, // Nullable
                'akta' => null, // Nullable
                'ijazah_terakhir' => null, // Nullable
                'img' => null, // Nullable
                'status' => 'aktif', // Semua aktif sesuai permintaan
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}