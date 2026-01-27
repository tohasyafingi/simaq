<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public $skipped = [];

    public function model(array $row)
    {
        Log::info("Memproses baris: " . json_encode($row));

        try {
            return DB::transaction(function () use ($row) {
                $siswa = Siswa::create([
                    'nis' => $row['nis'],
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'no_hp' => $row['no_hp'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tanggal_lahir' => \Carbon\Carbon::createFromFormat('Y-m-d', $row['tanggal_lahir']),
                    'alamat' => $row['alamat'],
                    'status' => $row['status'],
                ]);

                $plainPassword = $row['nis'];

                $user = User::create([
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'password' => Hash::make($plainPassword),
                    'role' => 'siswa',
                    'siswa_id' => $siswa->id,
                    'status' => strtolower($row['status']) === 'aktif',
                ]);

                // try {
                //     $user->notify(new WelcomeNotification($plainPassword));
                // } catch (\Exception $e) {
                //     Log::error('Gagal mengirim WelcomeNotification (siswa import): ' . $e->getMessage());
                // }

                return $siswa;
            });
        } catch (\Exception $e) {
            Log::error("Gagal import baris: " . json_encode($row) . " | Error: " . $e->getMessage());
            throw $e;
        }
    }

    public function rules(): array
    {
        return [
            'nis' => ['required', Rule::unique('siswas', 'nis')],
            'nama' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('siswas', 'email'),
                Rule::unique('users', 'email'),
            ],
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif,lulus',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.unique' => 'NIS sudah ada.',
            'nama.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'status.in' => 'Status harus aktif, tidak_aktif, atau lulus.',
        ];
    }

    public function onError(\Throwable $e)
    {
        Log::error("Error on import: " . $e->getMessage());
    }

    public function batchSize(): int
    {
        return 100;
    }

    // ✅ Tambahkan getter agar bisa diakses dari Livewire
    public function getErrors()
    {
        return $this->errors();
    }

    public function getFailures()
    {
        return $this->failures();
    }
}
