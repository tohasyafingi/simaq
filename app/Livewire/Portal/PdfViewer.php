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
        // Ambil data buku dari database menggunakan slug atau ID
        if (is_numeric($book)) {
            // Jika parameter adalah angka, cari berdasarkan ID (backward compatibility)
            $this->book = Books::findOrFail($book);
        } else {
            // Jika parameter adalah string, cari berdasarkan slug
            $this->book = Books::where('status', 1)
                ->get()
                ->first(function ($item) use ($book) {
                    return Str::slug($item->judul) === $book;
                });
            abort_if(!$this->book, 404);
        }
        $this->pdfUrl = $this->book->file ? asset('storage/' . $this->book->file) : null;
    }

    public function render()
    {
        $canonical = $this->book
            ? route('pdf-viewer', $this->book->slug ?? Str::slug($this->book->judul) ?? $this->book->id)
            : url()->current();

        $meta = [
            'title' => $this->book->judul ?? 'E-Book',
            'description' => Str::limit(strip_tags($this->book->description ?? ''), 160),
            'image' => \App\Helpers\SeoHelper::image($this->book->image ?? null),
            'canonical' => $canonical,
            'og_type' => 'book'
        ];

        return view('livewire.portal.pdf-viewer', [
            'pdfUrl' => $this->pdfUrl,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
