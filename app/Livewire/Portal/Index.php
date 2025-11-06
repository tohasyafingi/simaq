<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use App\Models\KaryaIlmiah;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Beranda')]
#[Layout('components.layouts.portal')]
class Index extends Component
{
    public $beritas;
    public $karya_ilmiahs;

    public function mount()
    {
        $this->beritas = Berita::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $this->karya_ilmiahs = KaryaIlmiah::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.index');
    }
}
