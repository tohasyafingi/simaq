<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Gallery as PhotoGallery;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Galeri')]
#[Layout('components.layouts.portal')]
class Gallery extends Component
{
    public $selectedGallery = null;
    public $galleryImages = [];

    public function selectGallery($id)
    {
        $gallery = PhotoGallery::with('details')->findOrFail($id);
        $this->galleryImages = $gallery->details->pluck('image_path')->toArray();
        $this->dispatch('openGalleryModal');
    }

    public function render()
    {
        $galleries = PhotoGallery::where('status', 1)
            ->latest()
            ->get();

        return view('livewire.portal.gallery', compact('galleries'));
    }
}
