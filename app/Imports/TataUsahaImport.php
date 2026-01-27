<?php

namespace App\Imports;

use App\Models\TataUsaha;
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
use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use App\Notifications\WelcomeNotification;

class TataUsahaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public $skipped = []; // Baris yang di-skip

    // Method untuk mengakses properti protected dari trait
    public function getErrors()
    {
        return $this->errors;
    }

    public function getFailures()
    {
        return $this->failures;
    }

    public function model(array $row)
    {
        try {
            Log::info("Memproses baris: " . json_encode($row));

            return DB::transaction(function () use ($row) {
                $tata_usaha = TataUsaha::create([
                    'kd_tu' => $row['kode_tu'],
                    'name'    => $row['nama'],
                    'email'   => $row['email'],
                    'no_hp'   => $row['no_hp'],
                    'status'  => strtolower($row['status']) === 'aktif',
                ]);

                $plainPassword = $row['kode_tu'];

                $user = User::create([
                    'name'      => $row['nama'],
                    'email'     => $row['email'],
                    'password'  => Hash::make($plainPassword),
                    'role'      => 'karyawan',
                    'tata_usaha_id'   => $tata_usaha->id,
                    'status'    => strtolower($row['status']) === 'aktif',
                ]);

                // try {
                //     $user->notify(new WelcomeNotification($plainPassword));
                // } catch (\Exception $e) {
                //     Log::error('Gagal mengirim WelcomeNotification (tata usaha import): ' . $e->getMessage());
                // }

                Log::info("Berhasil simpan: {$row['kode_tu']}");
                return $tata_usaha;
            });
        } catch (\Exception $e) {
            Log::error("Gagal simpan baris: " . $e->getMessage());
            $this->skipped[] = $row;
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'kode_tu' => [
                'required',
                'string',
                Rule::unique('tata_usahas', 'kd_tu'),
            ],
            'nama'   => 'required|string',
            'email'  => [
                'required',
                'email',
                Rule::unique('tata_usahas', 'email'),
                Rule::unique('users', 'email'),
            ],
            'no_hp'  => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode_tu.required' => 'Kolom kode_tu wajib diisi.',
            'kode_tu.unique'   => 'Kode tata usaha sudah ada.',
            'nama.required'           => 'Kolom nama wajib diisi.',
            'email.required'          => 'Kolom email wajib diisi.',
            'email.email'             => 'Kolom email harus format email valid.',
            'email.unique'            => 'Email sudah digunakan.',
            'no_hp.required'          => 'Kolom no_hp wajib diisi.',
            'status.required'         => 'Kolom status wajib diisi.',
            'status.in'               => 'Kolom status harus "aktif" atau "tidak_aktif".',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }
}