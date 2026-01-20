<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('PPDB')]
#[Layout('components.layouts.portal')]
class Ppdb extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua PPDB aktif dari database
        $this->activities = Profiles::where('type', 'ppdb')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.ppdb');
    }
}
