<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Ekstrakurikuler extends Component
{
    public function render()
    {
        return view('livewire.portal.ekstrakurikuler')
        ->layout('components.layouts.portal');
    }
}
