<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Profiles;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('PPDB')]
#[Layout('components.layouts.portal')]
class Ppdb extends Component
{
    public $activities;

    public function mount()
    {
        // Ambil semua PPDB aktif dari database
        $this->activities = Profiles::where('type', 'ppdb')
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'SPMB',
            'description' => Str::limit(strip_tags(config('app.description', 'Informasi Pendaftaran (SPMB) Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.ppdb')->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
