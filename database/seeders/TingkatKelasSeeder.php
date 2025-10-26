<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TingkatKelasSeeder extends Seeder
{
    public function run()
    {
        $tingkatKelas = [
            ['tingkat' => 'Kelas 10', 'urutan' => 1, 'status' => true],
            ['tingkat' => 'Kelas 11', 'urutan' => 2, 'status' => true],
            ['tingkat' => 'Kelas 12', 'urutan' => 3, 'status' => true],
        ];

        foreach ($tingkatKelas as $tk) {
            DB::table('tingkat_kelas')->insert([
                'tingkat' => $tk['tingkat'],
                'urutan' => $tk['urutan'],
                'status' => $tk['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}