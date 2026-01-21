<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Struktur as StrukturModel;
use Illuminate\Support\Str;

#[Title('Struktur Organisasi')]
#[Layout('components.layouts.portal')]
class Struktur extends Component
{
    public $strukturs = [];

    public function mount()
    {
        // Ambil semua data Struktur yang aktif beserta relasi user
        $this->strukturs = StrukturModel::with('user')
            ->where('status', 1)
            ->orderBy('urutan', 'asc')
            ->get();
    }

    public function render()
    {
        $meta = [
            'title' => 'Struktur Organisasi',
            'description' => Str::limit(strip_tags(config('app.description', 'Struktur organisasi sekolah')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.struktur', [
            'strukturs' => $this->strukturs,
            'meta' => $meta,
        ]);
    }
}
