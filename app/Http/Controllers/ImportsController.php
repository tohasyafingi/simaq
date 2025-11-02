<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use App\Imports\SiswaImport;
// Tambahkan import lainnya

class ImportsController extends Controller
{
    public function importGuru(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return redirect()->back()->with('message', 'Data Guru berhasil diimpor.');
    }

    public function importSiswa(Request $request)
    {
        // Mirip dengan importGuru, ganti dengan SiswaImport
    }

    // Tambahkan method untuk Bendahara dan TataUsaha
}