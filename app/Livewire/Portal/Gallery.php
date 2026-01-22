<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Gallery as PhotoGallery;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

        $meta = [
            'title' => 'Galeri',
            'description' => Str::limit(strip_tags(config('app.description', 'Galeri foto dan media Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.gallery', compact('galleries'))
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
