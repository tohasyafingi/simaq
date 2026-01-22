<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;
use Illuminate\Support\Str;

#[Title('Ekstrakurikuler')]
#[Layout('components.layouts.portal')]
class Ekstrakurikuler extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua ekstrakurikuler aktif
        $this->activities = Profiles::where('type', 'ekstrakurikuler')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'Ekstrakurikuler',
            'description' => Str::limit(strip_tags(config('app.description', 'Kegiatan ekstrakurikuler Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.ekstrakurikuler')
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
