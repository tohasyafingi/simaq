<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Models\Kontak;

#[Title('Kontak')]
#[Layout('components.layouts.portal')]
class Contact extends Component
{
    public $kontak;

    public function mount()
    {
        // Ambil data kontak terbaru (bisa diganti logika sesuai kebutuhan)
        $this->kontak = Kontak::latest()->first();
    }

    public function render()
    {
        $meta = [
            'title' => 'Kontak',
            'description' => Str::limit(strip_tags(optional($this->kontak)->alamat ?? config('app.description', 'Kontak')), 160),
            'image' => \App\Helpers\SeoHelper::image(optional($this->kontak)->image ?? null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.contact', [
            'kontak' => $this->kontak,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
