<?php

namespace App\Imports;

use App\Models\TataUsaha;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TataUsahaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Buat TataUsaha
        $tata_usaha = TataUsaha::create([
            'kd_tu' => $row['kode_tu'],
            'name' => $row['nama'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        // Buat User terkait
        User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['kd_tu']),
            'role' => 'karyawan',
            'tata_usaha_id' => $tata_usaha->id,
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        return $tata_usaha;
    }

    public function rules(): array
    {
        return [
            'kode_tu' => 'required|unique:tata_usahas,kd_tu',
            'nama' => 'required',
            'email' => 'required|email|unique:tata_usahas,email|unique:users,email',
            'no_hp' => 'required',
            'status' => 'required|in:aktif,tidak_aktif',
        ];
    }
}