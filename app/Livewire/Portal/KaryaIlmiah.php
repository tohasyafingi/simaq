<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Karya Ilmiah')]
#[Layout('components.layouts.portal')]
class KaryaIlmiah extends Component
{
    public function render()
    {
        return view('livewire.portal.karya-ilmiah');
    }
}
