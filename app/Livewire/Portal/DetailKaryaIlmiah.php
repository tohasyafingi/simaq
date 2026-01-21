<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\KaryaIlmiah;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

        $meta = [
            'title' => $this->karyaIlmiah->judul,
            'description' => Str::limit(strip_tags($this->karyaIlmiah->isi), 160),
            'image' => \App\Helpers\SeoHelper::image($this->karyaIlmiah->thumbnail ?? $this->karyaIlmiah->thumbnail_url ?? null),
            'canonical' => url()->current(),
            'og_type' => 'article'
        ];

        return view('livewire.portal.detail-karya-ilmiah', [
            'karyaIlmiah' => $this->karyaIlmiah,
            'latestKarya' => $latestKarya,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
