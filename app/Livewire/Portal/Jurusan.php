<?php

namespace App\Livewire\Portal;

use Livewire\Component;

class Jurusan extends Component
{
    public function render()
    {
        return view('livewire.portal.jurusan')
        ->layout('components.layouts.portal');
    }
}
