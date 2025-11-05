<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('PPDB')]
#[Layout('components.layouts.portal')]
class Ppdb extends Component
{
    public function render()
    {
        return view('livewire.portal.ppdb');
    }
}
