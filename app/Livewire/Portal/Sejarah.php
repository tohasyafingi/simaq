<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;

#[Title('Sejarah')]
#[Layout('components.layouts.portal')]
class Sejarah extends Component
{
    public $sejarah;

    public function mount()
    {
        $this->sejarah = Profiles::where('type', 'sejarah')
            ->where('status', 1)
            ->latest()
            ->first();
    }

    public function render()
    {
        return view('livewire.portal.sejarah');
    }
}
