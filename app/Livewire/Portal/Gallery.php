<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        return view('livewire.portal.gallery')
        ->layout('components.layouts.portal');
    }
}
