<?php

namespace App\Livewire\Superadmin\Admin\Absensi;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Absensi')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.superadmin.admin.absensi.index');
    }
}
