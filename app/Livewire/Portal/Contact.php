<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return view('livewire.portal.contact')
        ->layout('components.layouts.portal');
    }
}
