<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Books;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Perpustakaan Digital')]
#[Layout('components.layouts.portal')]
class Artikel extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 6;

    // reset page saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Books::where('status', 1)
            ->when($this->search, fn($q) =>
                $q->where('judul', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.portal.artikel', [
            'books' => $books,
        ]);
    }
}
