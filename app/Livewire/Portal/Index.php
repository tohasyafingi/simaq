<?php

namespace App\Livewire\Portal;

use App\Models\Berita;
use App\Models\Kontak;
use Livewire\Component;
use App\Models\Profiles;
use Illuminate\Support\Str;
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
    public $kontak;
    public $galleryImages = [];
    public $selectedGallery = null;

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
        $this->kontak = Kontak::latest()->first();
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
        $meta = [
            'title' => 'Beranda',
            // 'description' => Str::limit(strip_tags(optional($this->tentang->first())->content ?? config('app.description', 'MA Takhassus Al-Qur’an Wonosobo berdiri atas kepedulian Yayasan Al-Asy’ariyyah terhadap perkembangan pendidikan di Kabupaten Wonosobo. Atas prakarsa KH. Achmad Faqih Muntaha, pada tahun 2007 dirintislah lembaga pendidikan menengah berbasis pesantren yang terbuka bagi seluruh lapisan masyarakat tanpa membedakan latar belakang ekonomi maupun sosial.')), 160),
            'description' => Str::limit(strip_tags(config('app.description', 'MA Takhassus Al-Qur’an Wonosobo berdiri atas kepedulian Yayasan Al-Asy’ariyyah terhadap perkembangan pendidikan di Kabupaten Wonosobo.')), 160),

            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website',
        ];

        return view('livewire.portal.index', [
            'galleries' => $galleries,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
