<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    protected $mode;

    public function __construct(string $mode = 'data')
    {
        $this->mode = $mode;
    }

    public function collection()
    {
        if ($this->mode === 'data') {
            // Export data riil dari database
            return Siswa::all(['nis', 'name', 'email', 'no_hp', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'status']);
        }
        
        if ($this->mode === 'lulus') {
            // Export hanya siswa yang statusnya 'lulus'
            return Siswa::where('status', 'lulus')->get([
                'nis',
                'name',
                'email',
                'no_hp',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
                'status'
            ]);
        }

        // Mode template: satu baris contoh
        return collect([
            [
                'NIS1234',           // nis
                'Nama Siswa',          // name
                'email@example.com',   // email (diperbaiki typo)
                '08123456789',         // no_hp
                'L',                   // jenis_kelamin
                'Jakarta',             // tempat_lahir
                '2000-01-01',          // tanggal_lahir
                'Alamat Lengkap',      // alamat
                'aktif',               // status
            ],
        ]);
    }

    public function headings(): array
    {
        return ['nis', 'nama', 'email', 'no_hp', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'status'];
    }
}
