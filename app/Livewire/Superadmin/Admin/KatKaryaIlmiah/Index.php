<?php

namespace App\Livewire\Superadmin\Admin\KatKaryaIlmiah;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Karya Ilmiah')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kat-karya-ilmiah.index', [
            'title' => 'Data Kategori Karya Ilmiah',
        ]);
    }
}
