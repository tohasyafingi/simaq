<?php

namespace App\Livewire\Superadmin\Admin\Galeri;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Galeri')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.galeri.index', [
            'title' => 'Galeri'
        ]);
    }
}
