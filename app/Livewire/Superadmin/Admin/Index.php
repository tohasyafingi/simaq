<?php

namespace App\Livewire\Superadmin\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard Admin')]
class Index extends Component
{
    public function render()
    {
        // Set locale secara global ke Bahasa Indonesia
        Carbon::setLocale('id');

        // Format waktu sekarang dalam bahasa Indonesia
        $waktuSekarang = Carbon::now()->translatedFormat('l, d F Y H:i');

        return view('livewire.superadmin.admin.index', [
            'title' => 'Dashboard Admin',
            'waktuSekarang' => $waktuSekarang,
        ]);
    }
}
