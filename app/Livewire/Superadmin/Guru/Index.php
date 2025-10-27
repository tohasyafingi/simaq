<?php

namespace App\Livewire\Superadmin\Guru;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Title;

#[Title('Dashboard Guru')]
class Index extends Component
{
    public function render()
    {
        Carbon::setLocale('id');

        $waktuSekarang = Carbon::now()->translatedFormat('l, d F Y H:i');

        return view('livewire.superadmin.guru.index', [
            'title' => 'Dashboard Guru',
            'waktuSekarang' => $waktuSekarang,
        ]);
    }
}
