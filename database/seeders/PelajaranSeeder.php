<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        $jurusanIds = DB::table('jurusans')->pluck('id');
        $tingkatIds = DB::table('tingkat_kelas')->pluck('id');

        // Daftar pelajaran disesuaikan untuk SMA
        $pelajarans = [
            'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi', 'Sejarah', 'Geografi', 'Ekonomi', 'Sosiologi', 'PKN', 'Agama', 'Seni Budaya', 'Penjas', 'Bahasa Jawa', 'TIK', 'Antropologi', 'Filsafat'
        ];

        $counter = 1;
        foreach ($jurusanIds as $jurusanId) {
            foreach ($tingkatIds as $tingkatId) {
                foreach ($pelajarans as $pelajaran) {
                    DB::table('pelajarans')->insert([
                        'kd_pelajaran' => 'PEL' . str_pad($counter++, 4, '0', STR_PAD_LEFT),
                        'nama' => $pelajaran,
                        'jurusan_id' => $jurusanId,
                        'tingkat_kelas_id' => $tingkatId,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}