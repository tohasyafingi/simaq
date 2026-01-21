<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Books;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

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
        return view('livewire.portal.pdf-viewer', [
            'pdfUrl' => $this->pdfUrl,
        ]);
    }
}
