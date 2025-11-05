<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Program Jurusan')]
#[Layout('components.layouts.portal')]
class Jurusan extends Component
{
    public function render()
    {
        return view('livewire.portal.jurusan');
    }
}
