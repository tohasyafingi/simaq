<?php

namespace App\Exports;

use App\Models\TataUsaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TataUsahaExport implements FromCollection, WithHeadings
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
            return TataUsaha::all(['kd_tu', 'name', 'email', 'no_hp', 'status'])->map(function ($tata_usaha) {
                return [
                    $tata_usaha->kd_tu,
                    $tata_usaha->name,
                    $tata_usaha->email,
                    $tata_usaha->no_hp,
                    $tata_usaha->status ? 'aktif' : 'tidak_aktif', // Konversi boolean ke string
                ];
            });
        }

        // Mode template: satu baris contoh
        return collect([
            [
                'TU0001',           // kd_tu
                'Nama TataUsaha',         // name
                'email@example.com', // email
                '08123456789',       // no_hp
                'aktif',             // status (sudah string)
            ],
        ]);
    }

    public function headings(): array
    {
        return ['kode_tu', 'nama', 'email', 'no_hp', 'status'];
    }
}