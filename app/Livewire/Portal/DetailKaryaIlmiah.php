<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\KaryaIlmiah;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Detail Karya Ilmiah')]
#[Layout('components.layouts.portal')]
class DetailKaryaIlmiah extends Component
{
    public $karyaIlmiah;

    public function mount($slug)
    {
        $this->karyaIlmiah = KaryaIlmiah::with('kategori')
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();
    }


    public function render()
    {
        $latestKarya = KaryaIlmiah::where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.portal.detail-karya-ilmiah', [
            'karyaIlmiah' => $this->karyaIlmiah,
            'latestKarya' => $latestKarya,
        ]);
    }
}
