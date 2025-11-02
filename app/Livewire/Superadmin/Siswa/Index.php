<?php

namespace App\Livewire\Superadmin\Siswa;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Title;

#[Title('Dashboard Siswa')]
class Index extends Component
{
    public function render()
    {
        Carbon::setLocale('id');

        $waktuSekarang = Carbon::now()->translatedFormat('l, d F Y H:i');

        return view('livewire.superadmin.siswa.index', [
            'title' => 'Dashboard Siswa',
            'waktuSekarang' => $waktuSekarang,
        ]);
    }
}
