<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Visi - Misi')]
#[Layout('components.layouts.portal')]
class VisiMisi extends Component
{
    public function render()
    {
        return view('livewire.portal.visi-misi');
    }
}
