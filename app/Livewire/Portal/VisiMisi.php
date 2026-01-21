<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;
use Illuminate\Support\Str;

#[Title('Visi - Misi')]
#[Layout('components.layouts.portal')]
class VisiMisi extends Component
{
    public $visi;
    public $misi;

    public function mount()
    {
        // Ambil konten visi (status aktif)
        $this->visi = Profiles::where('type', 'visi')
            ->where('status', 1)
            ->latest()
            ->first();

        // Ambil konten misi (status aktif)
        $this->misi = Profiles::where('type', 'misi')
            ->where('status', 1)
            ->latest()
            ->first();
    }

    public function render()
    {
        $meta = [
            'title' => 'Visi dan Misi',
            'description' => Str::limit(strip_tags(optional($this->visi)->content ?? config('app.description', 'Visi dan misi sekolah')), 160),
            'image' => \App\Helpers\SeoHelper::image(optional($this->visi)->image ?? null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.visi-misi')->with('meta', $meta);
    }
}
