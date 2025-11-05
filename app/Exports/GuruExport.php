<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
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
            return Guru::all(['kd_guru', 'name', 'email', 'no_hp', 'status'])->map(function ($guru) {
                return [
                    $guru->kd_guru,
                    $guru->name,
                    $guru->email,
                    $guru->no_hp,
                    $guru->status ? 'aktif' : 'tidak_aktif', // Konversi boolean ke string
                ];
            });
        }

        // Mode template: satu baris contoh
        return collect([
            [
                'GURU001',           // kd_guru
                'Nama Guru',         // name
                'email@example.com', // email
                '08123456789',       // no_hp
                'aktif',             // status (sudah string)
            ],
        ]);
    }

    public function headings(): array
    {
        return ['kode_guru', 'nama', 'email', 'no_hp', 'status'];
    }
}