<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Berita')]
#[Layout('components.layouts.portal')]
class Agenda extends Component
{
    public $beritas;

    public function mount()
    {
        $this->beritas = Berita::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.portal.agenda');
    }
}
