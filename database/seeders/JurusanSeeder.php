<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusans = [
            ['kode' => 'IPA', 'nama' => 'Ilmu Pengetahuan Alam', 'status' => true],
            ['kode' => 'IPS', 'nama' => 'Ilmu Pengetahuan Sosial', 'status' => true],
            ['kode' => 'BAHASA', 'nama' => 'Bahasa', 'status' => true],
        ];

        foreach ($jurusans as $j) {
            DB::table('jurusans')->insert([
                'kode' => $j['kode'],
                'nama' => $j['nama'],
                'status' => $j['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}