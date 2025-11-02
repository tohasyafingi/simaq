<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row['nis'],
            'name' => $row['nama'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => \Carbon\Carbon::parse($row['tanggal_lahir']),
            'alamat' => $row['alamat'],
            'status' => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'email' => 'required|email|unique:siswas,email',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'status' => 'required|in:aktif,tidak_aktif,lulus',
        ];
    }
}