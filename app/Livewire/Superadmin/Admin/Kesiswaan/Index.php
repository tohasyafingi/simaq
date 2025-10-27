<?php

namespace App\Livewire\Superadmin\Admin\Kesiswaan;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Kesiswaan')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kesiswaan.index', [
            'title' => 'Data Kesiswaan',
        ]);
    }
}
