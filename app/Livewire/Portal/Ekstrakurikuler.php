<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;

#[Title('Ekstrakurikuler')]
#[Layout('components.layouts.portal')]
class Ekstrakurikuler extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua ekstrakurikuler aktif
        $this->activities = Profiles::where('type', 'ekstrakurikuler')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.ekstrakurikuler');
    }
}
