<?php

namespace App\Imports;

use App\Models\Bendahara;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BendaharaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Buat Bendahara
        $bendahara = Bendahara::create([
            'kd_bendahara' => $row['kode_bendahara'],
            'name' => $row['nama'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        // Buat User terkait
        User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['kode_bendahara']),
            'role' => 'bendahara',
            'bendahara_id' => $bendahara->id,
            'status' => $row['status'] == 'aktif' ? true : false,
        ]);

        return $bendahara;
    }

    public function rules(): array
    {
        return [
            'kode_bendahara' => 'required|unique:bendaharas,kd_bendahara',
            'nama' => 'required',
            'email' => 'required|email|unique:bendaharas,email|unique:users,email',
            'no_hp' => 'required',
            'status' => 'required|in:aktif,tidak_aktif',
        ];
    }
}