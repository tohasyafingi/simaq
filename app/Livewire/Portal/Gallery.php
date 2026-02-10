<?php

namespace App\Livewire\Portal;

use App\Helpers\ImageHelper;
use App\Helpers\SeoHelper;
use Livewire\Component;
use App\Models\Gallery as PhotoGallery;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('Galeri')]
#[Layout('components.layouts.portal')]
class Gallery extends Component
{
    public $newImage;
    public $selectedGallery = null;
    public $galleryImages = [];

    public function mount($slug = null)
    {
        if ($slug) {
            $gallery = PhotoGallery::where('status', 1)
                ->get()
                ->first(function ($item) use ($slug) {
                    $itemSlug = $item->slug ?? Str::slug($item->judul);
                    return $itemSlug === $slug;
                });

            abort_if(!$gallery, 404);

            $gallery->load('details');

            $this->selectedGallery = $gallery;
            $this->galleryImages = $gallery->details
                ->pluck('image_path')
                ->toArray();

            $this->dispatch('openGalleryModal');
        }
    }

    public function selectGallery($id)
        // Example: Add image upload logic (if needed)
        // if ($this->newImage) {
        //     $imagePath = ImageHelper::storeOptimized($this->newImage, 'gallery', 'public');
        //     // Save $imagePath to the gallery or details as needed
        // }
    {
        $gallery = PhotoGallery::with('details')->findOrFail($id);

        $this->selectedGallery = $gallery;
        $this->galleryImages = $gallery->details
            ->pluck('image_path')
            ->toArray();

        // update URL tanpa reload
        $slug = $gallery->slug ?? Str::slug($gallery->judul);
        $this->js("history.pushState({}, '', '/gallery/{$slug}');");

        $this->dispatch('openGalleryModal');
    }

    public function render()
    {
        $galleries = PhotoGallery::where('status', 1)
            ->latest()
            ->get();

        $title = $this->selectedGallery?->judul ?? 'Galeri';
        $description = $this->selectedGallery?->deskripsi
            ?? config('app.description', 'Galeri kegiatan MA Takhassus Al-Qur`an Wonosobo');
        $image = SeoHelper::image($this->selectedGallery?->thumbnail ?? null);
        $canonical = $this->selectedGallery
            ? route('galeri-show', $this->selectedGallery->slug ?? Str::slug($this->selectedGallery->judul))
            : route('galeri');

        $meta = [
            'title' => $title,
            'description' => Str::limit(strip_tags($description), 160),
            'image' => $image,
            'canonical' => $canonical,
            'og_type' => $this->selectedGallery ? 'article' : 'website',
        ];

        return view('livewire.portal.gallery', compact('galleries'))
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}

