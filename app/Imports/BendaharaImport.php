<?php

namespace App\Imports;

use App\Models\Bendahara;
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

class BendaharaImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnError, 
    SkipsOnFailure, 
    WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public $skipped = []; // Baris yang di-skip
    public $errorMessages = []; // Tambahan: simpan pesan error

    public function model(array $row)
    {
        try {
            Log::info("Memproses baris: " . json_encode($row));

            return DB::transaction(function () use ($row) {

                $bendahara = Bendahara::create([
                    'kd_bendahara' => $row['kode_bendahara'],
                    'name'         => $row['nama'],
                    'email'        => $row['email'],
                    'no_hp'        => $row['no_hp'],
                    'status'       => strtolower($row['status']) === 'aktif',
                ]);

                $plainPassword = $row['kode_bendahara'];

                $user = User::create([
                    'name'          => $row['nama'],
                    'email'         => $row['email'],
                    'password'      => Hash::make($plainPassword),
                    'role'          => 'bendahara',
                    'bendahara_id'  => $bendahara->id,
                    'status'        => strtolower($row['status']) === 'aktif',
                ]);

                // try {
                //     $user->notify(new WelcomeNotification($plainPassword));
                // } catch (\Exception $e) {
                //     Log::error('Gagal mengirim WelcomeNotification (bendahara import): ' . $e->getMessage());
                // }

                Log::info("Berhasil simpan: {$row['kode_bendahara']}");
                return $bendahara;
            });
        } catch (\Exception $e) {
            Log::error("Gagal simpan baris: " . $e->getMessage());
            $this->skipped[] = $row;
            $this->errorMessages[] = $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'kode_bendahara' => [
                'required',
                'string',
                Rule::unique('bendaharas', 'kd_bendahara'),
            ],
            'nama'   => 'required|string',
            'email'  => [
                'required',
                'email',
                Rule::unique('bendaharas', 'email'),
                Rule::unique('users', 'email'),
            ],
            'no_hp'  => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kode_bendahara.required' => 'Kolom kode_bendahara wajib diisi.',
            'kode_bendahara.unique'   => 'Kode bendahara sudah ada.',
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