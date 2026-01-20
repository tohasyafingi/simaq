<?php

namespace App\Livewire\Superadmin\Admin\EBook;

use App\Models\Books as Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Title('E-Book')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Data E-Book';
    public $paginate = 10;
    public $search = '';

    // Form fields
    public $book_id;
    public $judul;
    public $description;
    public $image;
    public $newImage;
    public $file;
    public $newFile;
    public $link;
    public $status = true;

    public $deleteId = null;

    /* ================= VALIDATION ================= */

    protected function rules()
    {
        return [
            'judul'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'newImage'    => 'nullable|image|max:2048',
            'newFile'     => 'nullable|file|mimes:pdf|max:10240',
        ];
    }

    /* ================= RENDER ================= */

    public function render()
    {
        $books = Book::where(function ($q) {
                if ($this->search) {
                    $q->where('judul', 'like', '%' . $this->search . '%');
                }
            })
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.e-book.index', [
            'title' => $this->title,
            'books' => $books,
        ]);
    }

    /* ================= HELPER ================= */

    public function resetInputFields()
    {
        $this->book_id = null;
        $this->judul = '';
        $this->description = '';
        $this->image = null;
        $this->newImage = null;
        $this->file = null;
        $this->newFile = null;
        $this->link = '';
        $this->status = true;
    }

    /* ================= CRUD ================= */

    public function create()
    {
        $this->resetValidation();
        $this->resetInputFields();
    }

    public function store()
    {
        $validated = $this->validate();

        if ($this->newImage) {
            $validated['image'] = $this->newImage->store('books/images', 'public');
        }

        if ($this->newFile) {
            $validated['file'] = $this->newFile->store('books/files', 'public');
        }

        Book::create($validated);

        $this->resetPage();
        $this->dispatch('closeCreateModal');
        session()->flash('message', 'E-Book berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $data = Book::findOrFail($id);

        $this->book_id = $data->id;
        $this->judul = $data->judul;
        $this->description = $data->description;
        $this->image = $data->image;
        $this->file = $data->file;
        $this->link = $data->link;
        $this->status = $data->status;
    }

    public function update()
    {
        $validated = $this->validate();

        $data = Book::findOrFail($this->book_id);

        if ($this->newImage) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }
            $validated['image'] = $this->newImage->store('books/images', 'public');
        } else {
            $validated['image'] = $data->image;
        }

        if ($this->newFile) {
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }
            $validated['file'] = $this->newFile->store('books/files', 'public');
        } else {
            $validated['file'] = $data->file;
        }

        $data->update($validated);

        $this->resetPage();
        $this->dispatch('closeEditModal');
        session()->flash('message', 'E-Book berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $data = Book::findOrFail($this->deleteId);

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        if ($data->file) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        $this->resetPage();
        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'E-Book berhasil dihapus.');
        $this->deleteId = null;
    }
}
