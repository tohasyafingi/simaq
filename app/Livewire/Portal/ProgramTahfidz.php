<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Program Tahfidz')]
#[Layout('components.layouts.portal')]
class ProgramTahfidz extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua Tahfidz aktif dari database
        $this->activities = Profiles::where('type', 'tahfidz')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.program-tahfidz');
    }
}
