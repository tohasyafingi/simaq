<?php

namespace App\Exports;

use App\Models\TataUsaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TataUsahaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TataUsaha::all(['kd_tu', 'name', 'email', 'no_hp', 'status']);
    }

    public function headings(): array
    {
        return ['KD TU', 'Nama', 'Email', 'No. HP', 'Status'];
    }
}

