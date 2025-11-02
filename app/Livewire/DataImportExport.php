<?php

namespace App\Livewire;

use App\Exports\SiswaExport;
use App\Exports\GuruExport;
use App\Exports\BendaharaExport;
use App\Exports\TataUsahaExport;
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use App\Imports\BendaharaImport;
use App\Imports\TataUsahaImport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\Title;

#[Title('Data Imports & Exports')]
class DataImportExport extends Component
{
    public function exportSiswa()
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function exportGuru()
    {
        return Excel::download(new GuruExport, 'guru.xlsx');
    }

    public function exportBendahara()
    {
        return Excel::download(new BendaharaExport, 'bendahara.xlsx');
    }

    public function exportTataUsaha()
    {
        return Excel::download(new TataUsahaExport, 'tata_usaha.xlsx');
    }

    public function importSiswa($file)
    {
        Excel::import(new SiswaImport, $file);
        session()->flash('message', 'Data Siswa berhasil di-import.');
    }

    public function importGuru($file)
    {
        Excel::import(new GuruImport, $file);
        session()->flash('message', 'Data Guru berhasil di-import.');
    }

    public function importBendahara($file)
    {
        Excel::import(new BendaharaImport, $file);
        session()->flash('message', 'Data Bendahara berhasil di-import.');
    }

    public function importTataUsaha($file)
    {
        Excel::import(new TataUsahaImport, $file);
        session()->flash('message', 'Data Tata Usaha berhasil di-import.');
    }

    public function render()
    {
        return view('livewire.data-import-export', [
            'title' => 'Data Imports & Exports'
        ]);
    }
}
