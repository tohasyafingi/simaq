<?php

namespace App\Exports;

use App\Models\Bendahara;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BendaharaExport implements FromCollection, WithHeadings
{
    protected $mode;

    public function __construct(string $mode = 'data')
    {
        $this->mode = $mode;
    }

    public function collection()
    {
        if ($this->mode === 'data') {
            // Export data riil dari database, dengan konversi status boolean ke string
            return Bendahara::all(['kd_bendahara', 'name', 'email', 'no_hp', 'status'])->map(function ($bendahara) {
                return [
                    $bendahara->kd_bendahara,
                    $bendahara->name,
                    $bendahara->email,
                    $bendahara->no_hp,
                    $bendahara->status ? 'aktif' : 'tidak_aktif', // Konversi boolean ke string
                ];
            });
        }

        // Mode template: satu baris contoh
        return collect([
            [
                'Benda001',           // kd_bendahara
                'Nama Bendahara',         // name
                'email@example.com', // email
                '628123456789',       // no_hp
                'aktif',             // status (sudah string)
            ],
        ]);
    }

    public function headings(): array
    {
        return ['kode_bendahara', 'nama', 'email', 'no_hp', 'status'];
    }
}