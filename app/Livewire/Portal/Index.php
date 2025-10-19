<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;

class Index extends Component
{
    public $beritas;

    public function mount()
    {
        $this->beritas = Berita::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(6) // Batasi hanya 6 berita terbaru
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.index')
            ->layout('components.layouts.portal');
    }
}
