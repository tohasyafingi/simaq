<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Profiles;

#[Title('Program Jurusan')]
#[Layout('components.layouts.portal')]
class Jurusan extends Component
{
    public $jurusans;

    public function mount()
    {
        // Ambil semua konten jurusan aktif
        $this->jurusans = Profiles::where('type', 'jurusan')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'Jurusan',
            'description' => Str::limit(strip_tags(config('app.description', 'Informasi jurusan Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.jurusan')->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
