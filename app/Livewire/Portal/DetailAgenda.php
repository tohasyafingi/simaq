<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Berita')]
#[Layout('components.layouts.portal')]
class DetailAgenda extends Component
{
    public $beritaId;
    public $berita;

public function mount($slug)
{
    $this->berita = Berita::with('kategori')
        ->where('status', 1)
        ->where('slug', $slug)
        ->firstOrFail();
}

    public function render()
    {
        $latestBeritas = Berita::where('status', 1)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('livewire.portal.detail-agenda', [
            'berita' => $this->berita,
            'latestBeritas' => $latestBeritas,
        ]);
    }
}
