<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Download extends Component
{
    public function render()
    {
        return view('livewire.portal.download')
        ->layout('components.layouts.portal');
    }
}
