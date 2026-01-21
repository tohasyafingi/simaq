<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Books;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Title('Perpustakaan Digital')]
#[Layout('components.layouts.portal')]
class PdfViewer extends Component
{
    public $book;
    public $pdfUrl;

    public function mount($book)
    {
        // Ambil data buku dari database
        $this->book = Books::findOrFail($book);
        $this->pdfUrl = $this->book->file ? asset('storage/' . $this->book->file) : null;
    }

    public function render()
    {
        $meta = [
            'title' => $this->book->judul ?? 'E-Book',
            'description' => Str::limit(strip_tags($this->book->description ?? ''), 160),
            'image' => \App\Helpers\SeoHelper::image($this->book->cover ?? null),
            'canonical' => url()->current(),
            'og_type' => 'book'
        ];

        return view('livewire.portal.pdf-viewer', [
            'pdfUrl' => $this->pdfUrl,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
