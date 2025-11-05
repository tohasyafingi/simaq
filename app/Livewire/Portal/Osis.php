<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('OSIS')]
#[Layout('components.layouts.portal')]
class Osis extends Component
{
    public function render()
    {
        return view('livewire.portal.osis');
    }
}
