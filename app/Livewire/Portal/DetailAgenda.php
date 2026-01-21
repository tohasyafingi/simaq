<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

        $meta = [
            'title' => $this->berita->judul,
            'description' => Str::limit(strip_tags($this->berita->isi), 160),
            'image' => \App\Helpers\SeoHelper::image($this->berita->thumbnail ?? $this->berita->thumbnail_url ?? null),
            'canonical' => url()->current(),
            'og_type' => 'article'
        ];

        return view('livewire.portal.detail-agenda', [
            'berita' => $this->berita,
            'latestBeritas' => $latestBeritas,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
        
    }
}
