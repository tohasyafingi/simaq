<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Sejarah')]
#[Layout('components.layouts.portal')]
class Sejarah extends Component
{
    public function render()
    {
        return view('livewire.portal.sejarah');
    }
}
