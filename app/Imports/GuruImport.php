<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts; // Tambahkan untuk batch insert

class GuruImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public $skipped = []; // Array untuk baris yang di-skip (opsional, jika perlu)

    public function model(array $row)
    {
        try {
            // Hapus cek duplikat manual – biarkan validasi unik menangani
            // Jika duplikat, validasi akan gagal dan baris di-skip oleh SkipsFailures

            Log::info("Memproses baris: " . json_encode($row)); // Logging untuk debug

            return DB::transaction(function () use ($row) {
                // Buat Guru
                $guru = Guru::create([
                    'kd_guru' => $row['kode_guru'],
                    'name'    => $row['nama'],
                    'email'   => $row['email'],
                    'no_hp'   => $row['no_hp'],
                    'status'  => strtolower($row['status']) === 'aktif' ? true : false,
                ]);

                // Buat User terkait
                User::create([
                    'name'      => $row['nama'],
                    'email'     => $row['email'],
                    'password'  => Hash::make($row['kode_guru']),
                    'role'      => 'guru',
                    'guru_id'   => $guru->id,
                    'status'    => strtolower($row['status']) === 'aktif' ? true : false,
                ]);

                Log::info("Berhasil simpan baris: kd_guru={$row['kode_guru']}"); // Logging sukses
                return $guru;
            });
        } catch (\Exception $e) {
            Log::error("Gagal import baris: " . json_encode($row) . " | Error: " . $e->getMessage());
            return null; // Skip baris jika error
        }
    }

    public function rules(): array
    {
        return [
            'kode_guru' => [
                'required',
                'string',
                Rule::unique('gurus', 'kd_guru'), // Unique untuk mencegah duplikat
            ],
            'nama'      => 'required|string',
            'email'     => [
                'required',
                'email',
                Rule::unique('gurus', 'email'), // Unique di gurus
                Rule::unique('users', 'email'), // Unique di users
            ],
            'no_hp'     => 'required|string',
            'status'    => 'required|in:aktif,tidak_aktif',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode_guru.required' => 'Kolom kode_guru wajib diisi.',
            'kode_guru.unique'   => 'Kode guru sudah ada.',
            'nama.required'      => 'Kolom nama wajib diisi.',
            'email.required'     => 'Kolom email wajib diisi.',
            'email.email'        => 'Kolom email harus format email yang valid.',
            'email.unique'       => 'Email sudah digunakan.',
            'no_hp.required'     => 'Kolom no_hp wajib diisi.',
            'status.required'    => 'Kolom status wajib diisi.',
            'status.in'          => 'Kolom status harus "aktif" atau "tidak_aktif".',
        ];
    }

    public function batchSize(): int
    {
        return 100; // Batch insert untuk performa, jika data besar
    }
}