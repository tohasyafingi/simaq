<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Guru::all(['kd_guru', 'name', 'email', 'no_hp', 'status']);
    }

    public function headings(): array
    {
        return ['KD Guru', 'Nama', 'Email', 'No. HP', 'Status'];
    }
}

