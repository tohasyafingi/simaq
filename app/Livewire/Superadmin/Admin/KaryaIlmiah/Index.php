<?php

namespace App\Livewire\Superadmin\Admin\KaryaIlmiah;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Karya Ilmiah')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.karya-ilmiah.index', [
            'title' => 'Data Karya Ilmiah',
        ]);
    }
}
