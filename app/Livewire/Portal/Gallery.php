<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Galeri')]
#[Layout('components.layouts.portal')]
class Gallery extends Component
{
    public function render()
    {
        return view('livewire.portal.gallery');
    }
}
