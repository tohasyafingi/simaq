<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Downloads')]
#[Layout('components.layouts.portal')]
class Download extends Component
{
    public function render()
    {
        return view('livewire.portal.download');
    }
}
