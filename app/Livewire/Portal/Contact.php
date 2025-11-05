<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Kontak')]
#[Layout('components.layouts.portal')]
class Contact extends Component
{
    public function render()
    {
        return view('livewire.portal.contact');
    }
}
