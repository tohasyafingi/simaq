<?php

namespace App\Livewire\Superadmin\Admin\Kontak;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Kontak')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.kontak.index');
    }
}
