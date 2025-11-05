<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Program Tahfidz')]
#[Layout('components.layouts.portal')]
class ProgramTahfidz extends Component
{
    public function render()
    {
        return view('livewire.portal.program-tahfidz');
    }
}
