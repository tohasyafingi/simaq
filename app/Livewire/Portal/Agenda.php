<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Berita;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
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
                    ->orWhere('isi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('livewire.portal.agenda', compact('beritas'));
    }
}
