<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Pramuka')]
#[Layout('components.layouts.portal')]
class Pramuka extends Component
{
    public function render()
    {
        return view('livewire.portal.pramuka');
    }
}
