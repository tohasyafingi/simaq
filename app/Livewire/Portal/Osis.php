<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('OSIS')]
#[Layout('components.layouts.portal')]
class Osis extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua OSIS aktif
        $this->activities = Profiles::where('type', 'osis')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'OSIS',
            'description' => Str::limit(strip_tags(config('app.description', 'Kegiatan OSIS')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.osis')->with('meta', $meta);
    }
}
