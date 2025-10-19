<?php

namespace App\Livewire\Superadmin\Admin\KatKaryaIlmiah;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kat-karya-ilmiah.index', [
            'title' => 'Data Kategori Karya Ilmiah',
        ])->title('Kategori Karya Ilmiah');
    }
}
