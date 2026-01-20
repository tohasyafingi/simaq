<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Pramuka')]
#[Layout('components.layouts.portal')]
class Pramuka extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua Pramuka aktif dari database
        $this->activities = Profiles::where('type', 'pramuka')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.pramuka');
    }
}
