<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GuruImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Buat Guru
        $guru = Guru::create([
            'kd_guru' => $row['kode_guru'],
            'name' => $row['nama'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        // Buat User terkait
        User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['kode_guru']),
            'role' => 'guru',
            'guru_id' => $guru->id,
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        return $guru;
    }

    public function rules(): array
    {
        return [
            'kode_guru' => 'required|unique:gurus,kd_guru',
            'nama' => 'required',
            'email' => 'required|email|unique:gurus,email|unique:users,email',
            'no_hp' => 'required',
            'status' => 'required|in:aktif,tidak_aktif',
        ];
    }
}