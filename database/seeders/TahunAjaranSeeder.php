<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        $tahunAjarans = [
            ['tahun' => '2022/2023', 'semester' => 'Ganjil', 'status' => false],
            ['tahun' => '2023/2024', 'semester' => 'Genap', 'status' => false],
            ['tahun' => '2024/2025', 'semester' => 'Ganjil', 'status' => true], // Aktif
        ];

        foreach ($tahunAjarans as $ta) {
            DB::table('tahun_ajarans')->insert([
                'tahun' => $ta['tahun'],
                'semester' => $ta['semester'],
                'status' => $ta['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}