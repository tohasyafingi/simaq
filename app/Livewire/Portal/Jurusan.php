<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;

#[Title('Program Jurusan')]
#[Layout('components.layouts.portal')]
class Jurusan extends Component
{
    public $jurusans;

    public function mount()
    {
        // Ambil semua konten jurusan aktif
        $this->jurusans = Profiles::where('type', 'jurusan')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.jurusan');
    }
}
