<?php

namespace App\Livewire\Superadmin\Admin\Profil;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.profil.index', [
            'title' => 'Data Profil',
        ])->title('Profil');
    }
}
