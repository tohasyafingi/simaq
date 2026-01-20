<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('OSIS')]
#[Layout('components.layouts.portal')]
class Osis extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua OSIS aktif
        $this->activities = Profiles::where('type', 'osis')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.osis');
    }
}
