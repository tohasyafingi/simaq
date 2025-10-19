<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Siswa::create([
                'nis' => 'NIS' . str_pad($i, 4, '0', STR_PAD_LEFT), // NIS0001, NIS0002, ...
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'no_hp' => fake()->phoneNumber(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
                'tempat_lahir' => fake()->city(),
                'tanggal_lahir' => fake()->date('Y-m-d', '2008-12-31'),
                'alamat' => fake()->address(),
                'kk' => null,
                'akta' => null,
                'ijazah_terakhir' => null,
                'img' => null,
                'status' => 'aktif',
            ]);
        }

        $this->command->info('✅ Seeder SiswaSeeder berhasil menambahkan 50 data siswa.');
    }
}
