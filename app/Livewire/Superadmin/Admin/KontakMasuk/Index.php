<?php

namespace App\Livewire\Superadmin\Admin\KontakMasuk;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Data Kontak Masuk')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kontak-masuk.index', [
            'title' => 'Data Kontak Masuk',
        ]);
    }
}
