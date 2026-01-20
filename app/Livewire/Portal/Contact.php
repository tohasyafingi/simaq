<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Kontak;

#[Title('Kontak')]
#[Layout('components.layouts.portal')]
class Contact extends Component
{
    public $kontak;

    public function mount()
    {
        // Ambil data kontak terbaru (bisa diganti logika sesuai kebutuhan)
        $this->kontak = Kontak::latest()->first();
    }

    public function render()
    {
        return view('livewire.portal.contact', [
            'kontak' => $this->kontak
        ]);
    }
}
