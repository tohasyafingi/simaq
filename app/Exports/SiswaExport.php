<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Siswa::all(['nis', 'name', 'email', 'no_hp', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'status']);
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Email', 'No. HP', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat', 'Status'];
    }
}
