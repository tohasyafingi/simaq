<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Books;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use App\Helpers\SeoHelper;

#[Title('Perpustakaan Digital')]
#[Layout('components.layouts.portal')]
class Artikel extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 6;
    public $slug = null;

    public function mount($slug = null)
    {
        $this->slug = $slug;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Books::where('status', 1)
            ->when(
                $this->slug,
                fn ($q) => $q->where('slug', $this->slug)
            )
            ->when(
                $this->search && !$this->slug,
                fn ($q) =>
                    $q->where(function ($sub) {
                        $sub->where('judul', 'like', "%{$this->search}%")
                            ->orWhere('description', 'like', "%{$this->search}%");
                    })
            )
            ->latest()
            ->paginate($this->slug ? 1 : $this->perPage);

        if ($this->slug && $books->isEmpty()) {
            abort(404);
        }

        $item = $this->slug ? $books->first() : null;

        $meta = [
            'title' => $item?->judul ?? 'Perpustakaan Digital',
            'description' => Str::limit(strip_tags(
                $item?->description ?? config('app.description', 'Perpustakaan Digital')
            ), 160),
            'image' => SeoHelper::image($item?->image ?? null),
            'canonical' => url()->current(),
            'og_type' => $item ? 'article' : 'website',
        ];

        return view('livewire.portal.artikel', [
            'books' => $books,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
