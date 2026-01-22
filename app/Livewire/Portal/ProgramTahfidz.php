<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('Program Tahfidz')]
#[Layout('components.layouts.portal')]
class ProgramTahfidz extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua Tahfidz aktif dari database
        $this->activities = Profiles::where('type', 'tahfidz')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'Program Tahfidz',
            'description' => Str::limit(strip_tags(config('app.description', 'Program tahfidz Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.program-tahfidz')
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
