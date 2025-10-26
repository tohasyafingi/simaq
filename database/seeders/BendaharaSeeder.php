<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BendaharaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 3; $i++) {
            DB::table('bendaharas')->insert([
                'kd_bendahara' => 'BEN' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'no_hp' => $faker->phoneNumber,
                'img' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}