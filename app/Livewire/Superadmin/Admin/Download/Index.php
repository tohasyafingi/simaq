<?php

namespace App\Livewire\Superadmin\Admin\Download;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\Downloads as Download;
use Illuminate\Support\Facades\Storage;

#[Title('Download')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Data Download';
    public $paginate = 10;
    public $search = '';

    // Form
    public $download_id;
    public $judul;
    public $description;
    public $status = 1;
    public $image;
    public $newImage;
    public $newFile;

    public $deleteId = null;

    /* ================= VALIDATION ================= */

    protected function rules()
    {
        return [
            'judul'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
            'newImage'    => 'nullable|image|max:2048',
            'newFile'     => $this->download_id
                ? 'nullable|file|max:10240'
                : 'required|file|max:10240',
        ];
    }

    /* ================= RENDER ================= */

    public function render()
    {
        $downloads = Download::where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.download.index', [
            'downloads' => $downloads,
            'title'     => $this->title,
        ]);
    }

    /* ================= HELPER ================= */

    public function resetForm()
    {
        $this->reset([
            'download_id',
            'judul',
            'description',
            'status',
            'image',
            'newImage',
            'newFile'
        ]);

        $this->status = 1;
    }

    /* ================= CREATE ================= */

    public function create()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->newImage) {
            $data['image'] = $this->newImage->store('downloads/images', 'public');
        }

        $data['file'] = $this->newFile->store('downloads/files', 'public');

        Download::create($data);

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Data berhasil ditambahkan.');
        $this->resetForm();
    }

    /* ================= EDIT ================= */

    public function edit($id)
    {
        $download = Download::findOrFail($id);

        $this->download_id = $download->id;
        $this->judul       = $download->judul;
        $this->description = $download->description;
        $this->status      = $download->status;
        $this->image       = $download->image;
    }

    public function update()
    {
        $data = $this->validate();

        $download = Download::findOrFail($this->download_id);

        // Image
        if ($this->newImage) {
            if ($download->image && Storage::disk('public')->exists($download->image)) {
                Storage::disk('public')->delete($download->image);
            }
            $data['image'] = $this->newImage->store('downloads/images', 'public');
        } else {
            $data['image'] = $download->image;
        }

        // File
        if ($this->newFile) {
            if ($download->file && Storage::disk('public')->exists($download->file)) {
                Storage::disk('public')->delete($download->file);
            }
            $data['file'] = $this->newFile->store('downloads/files', 'public');
        } else {
            $data['file'] = $download->file;
        }

        $download->update($data);

        $this->dispatch('closeEditModal');
        session()->flash('message', 'Data berhasil diperbarui.');
        $this->resetForm();
    }

    /* ================= DELETE ================= */

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $download = Download::findOrFail($this->deleteId);

        if ($download->image && Storage::disk('public')->exists($download->image)) {
            Storage::disk('public')->delete($download->image);
        }

        if ($download->file && Storage::disk('public')->exists($download->file)) {
            Storage::disk('public')->delete($download->file);
        }

        $download->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Data berhasil dihapus.');

        $this->deleteId = null;
    }
}
