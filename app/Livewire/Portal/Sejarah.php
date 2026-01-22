<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Profiles;
use Illuminate\Support\Str;

#[Title('Sejarah')]
#[Layout('components.layouts.portal')]
class Sejarah extends Component
{
    public $sejarah;

    public function mount()
    {
        $this->sejarah = Profiles::where('type', 'sejarah')
            ->where('status', 1)
            ->latest()
            ->first();
    }

    public function render()
    {
        $meta = [
            'title' => 'Sejarah',
            'description' => Str::limit(strip_tags(optional($this->sejarah)->content ?? config('app.description', 'Sejarah Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(optional($this->sejarah)->image ?? null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.sejarah')
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
