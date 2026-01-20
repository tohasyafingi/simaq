<?php

namespace App\Livewire\Portal;

use App\Models\Berita;
use Livewire\Component;
use App\Models\Profiles;
use App\Models\KaryaIlmiah;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Gallery as PhotoGallery;

#[Title('Beranda')]
#[Layout('components.layouts.portal')]
class Index extends Component
{
    public $beritas;
    public $karya_ilmiahs;
    public $ppdb;
    public $tentang;
    public $galleryImages = [];

    public function mount()
    {
        $this->ppdb = Profiles::where('type', 'ppdb')
            ->where('status', 1)
            ->latest()
            ->get();
        $this->tentang = Profiles::where('type', 'tentang')
            ->where('status', 1)
            ->latest()
            ->get();
        $this->beritas = Berita::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $this->karya_ilmiahs = KaryaIlmiah::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }
    public function selectGallery($id)
    {
        $gallery = PhotoGallery::with('details')->findOrFail($id);
        $this->galleryImages = $gallery->details->pluck('image_path')->toArray();
        $this->dispatch('openGalleryModal');
    }
    public function render()
    {
        $galleries = PhotoGallery::withCount('details')
            ->where('status', true) 
            ->latest()
            ->take(3)
            ->get();
        return view('livewire.portal.index', [
            'galleries' => $galleries,
        ]);
    }
}
