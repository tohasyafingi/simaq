<?php

namespace App\Livewire\Superadmin\Admin\Profil;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title(content: 'Profil')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.profil.index', [
            'title' => 'Data Profil',
        ]);
    }
}
