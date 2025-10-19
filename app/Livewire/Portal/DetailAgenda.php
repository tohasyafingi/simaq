<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;

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
        ])->layout('components.layouts.portal');
    }
}
