<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Books;
use Illuminate\Support\Str;
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

    public function getBookBySlug($slug)
    {
        return Books::where('status', 1)
            ->get()
            ->first(function ($item) use ($slug) {
                return Str::slug($item->judul) === $slug;
            });
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

        $meta = [
            'title' => 'Perpustakaan Digital',
            'description' => Str::limit(strip_tags(config('app.description', 'Perpustakaan digital')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.artikel', [
            'books' => $books,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
