<?php

namespace App\Livewire\Superadmin\Admin\Akademik;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Akademik')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.akademik.index', [
            'title' => 'Data Akademik',
        ]);
    }
}
