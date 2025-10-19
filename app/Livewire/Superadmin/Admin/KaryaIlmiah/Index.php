<?php

namespace App\Livewire\Superadmin\Admin\KaryaIlmiah;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.karya-ilmiah.index', [
            'title' => 'Data Karya Ilmiah',
        ])->title('Karya Ilmiah');
    }
}
