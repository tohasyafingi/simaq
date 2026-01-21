<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('Pramuka')]
#[Layout('components.layouts.portal')]
class Pramuka extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua Pramuka aktif dari database
        $this->activities = Profiles::where('type', 'pramuka')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'Pramuka',
            'description' => Str::limit(strip_tags(config('app.description', 'Kegiatan Pramuka')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.pramuka')->with('meta', $meta);
    }
}
