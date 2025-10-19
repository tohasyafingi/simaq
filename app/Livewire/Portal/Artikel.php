<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Artikel extends Component
{
    public function render()
    {
        return view('livewire.portal.artikel')
        ->layout('components.layouts.portal');
    }
}
