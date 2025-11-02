<?php

namespace App\Exports;

use App\Models\Bendahara;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BendaharaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Bendahara::all(['kd_bendahara', 'name', 'email', 'no_hp', 'status']);
    }

    public function headings(): array
    {
        return ['KD Bendahara', 'Nama', 'Email', 'No. HP', 'Status'];
    }
}

