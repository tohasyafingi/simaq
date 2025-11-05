<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Ekstrakurikuler')]
#[Layout('components.layouts.portal')]
class Ekstrakurikuler extends Component
{
    public function render()
    {
        return view('livewire.portal.ekstrakurikuler');
    }
}
