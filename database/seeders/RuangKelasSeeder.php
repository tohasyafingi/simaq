<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuangKelasSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('ruang_kelas')->insert([
                'nama' => 'Ruang ' . $i,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}