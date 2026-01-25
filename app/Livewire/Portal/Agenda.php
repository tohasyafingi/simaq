<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\WithPagination;

#[Title('Berita')]
#[Layout('components.layouts.portal')]
class Agenda extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $beritas = Berita::with('kategori')
            ->where('status', 1)
            ->where(function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isi', 'like', '%' . $this->search . '%')
                    ->orWhereHas('kategori', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $meta = [
            'title' => 'Berita & Agenda',
            'description' => Str::limit(strip_tags(config('app.description', 'Berita dan agenda Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => asset('assets/og-image.png'),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.agenda', compact('beritas'))
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
