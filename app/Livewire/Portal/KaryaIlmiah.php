<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class KaryaIlmiah extends Component
{
    public function render()
    {
        return view('livewire.portal.karya-ilmiah')
        ->layout('components.layouts.portal');
    }
}
