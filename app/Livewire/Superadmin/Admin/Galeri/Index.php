<?php

namespace App\Livewire\Superadmin\Admin\Galeri;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\Gallery;
use App\Models\GalleryDetail;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

#[Title('Galeri')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Galeri';
    public $paginate = 10;
    public $search = '';

    // form
    public $gallery_id;
    public $judul;
    public $deskripsi;
    public $status = true;
    public $thumbnail;
    public $newThumbnail;
    public $images = [];
    public $existingImages = [];
    public $removedImages = [];

    public $deleteId;

    protected function rules()
    {
        return [
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'status'       => 'required|boolean',
            'newThumbnail' => 'nullable|file|mimes:webp,jpg,jpeg,png,avif,svg,gif|max:5120',
            'images.*'     => 'nullable|file|mimes:webp,jpg,jpeg,png,avif,svg,gif|max:5120',
        ];
    }

    public function render()
    {
        $galleries = Gallery::withCount('details')
            ->where('judul', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.galeri.index', compact('galleries'));
    }

    /* ================= HELPER ================= */

public function resetForm()
{
    $this->gallery_id = null;
    $this->judul = '';
    $this->deskripsi = '';
    $this->status = true;

    $this->thumbnail = null;
    $this->newThumbnail = null;

    $this->images = [];
    $this->existingImages = [];
    $this->removedImages = [];
}


    public function create()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    /* ================= STORE ================= */

    public function store()
    {
        $data = $this->validate();

        if ($this->newThumbnail) {
            $data['thumbnail'] = ImageHelper::storeOptimized(
                $this->newThumbnail,
                'gallery/thumbnail',
                $this->judul,
                'public'
            );
        }

        $gallery = Gallery::create($data);

        foreach ($this->images as $image) {
            GalleryDetail::create([
                'gallery_id' => $gallery->id,
                'image_path' => ImageHelper::storeOptimized(
                    $image,
                    'gallery/images',
                    $this->judul,
                    'public'
                ),
            ]);
        }

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Galeri berhasil ditambahkan');
        $this->resetForm();
        $this->resetPage();
    }

    /* ================= EDIT ================= */

    public function edit($id)
    {
        $gallery = Gallery::with('details')->findOrFail($id);

        $this->gallery_id = $gallery->id;
        $this->judul = $gallery->judul;
        $this->deskripsi = $gallery->deskripsi;
        $this->status = $gallery->status;
        $this->thumbnail = $gallery->thumbnail;

        $this->existingImages = $gallery->details->toArray();
        $this->images = [];
        $this->removedImages = [];
    }

    public function update()
    {
        $data = $this->validate();
        $gallery = Gallery::findOrFail($this->gallery_id);

        // thumbnail
        if ($this->newThumbnail) {
            $data['thumbnail'] = ImageHelper::replaceOptimized(
                $gallery->thumbnail,
                $this->newThumbnail,
                'gallery/thumbnail',
                $this->judul,
                'public'
            );
        } else {
            $data['thumbnail'] = $gallery->thumbnail;
        }

        $gallery->update($data);

        // hapus foto lama
        if (!empty($this->removedImages)) {
            $details = GalleryDetail::whereIn('id', $this->removedImages)->get();

            foreach ($details as $detail) {
                ImageHelper::deletePath($detail->image_path, 'public');
                $detail->delete();
            }
        }

        // simpan foto baru
        foreach ($this->images as $image) {
            GalleryDetail::create([
                'gallery_id' => $gallery->id,
                'image_path' => ImageHelper::storeOptimized(
                    $image,
                    'gallery/images',
                    $this->judul,
                    'public'
                ),
            ]);
        }

        $this->dispatch('closeEditModal');
        session()->flash('message', 'Galeri berhasil diperbarui');
        $this->resetForm();
        $this->resetPage();
    }


    /* ================= DELETE ================= */
    public function removeNewImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function removeExistingImage($id)
    {
        $this->removedImages[] = $id;

        $this->existingImages = array_filter(
            $this->existingImages,
            fn($img) => $img['id'] !== $id
        );
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $gallery = Gallery::with('details')->findOrFail($this->deleteId);

        if ($gallery->thumbnail) {
            ImageHelper::deletePath($gallery->thumbnail, 'public');
        }

        foreach ($gallery->details as $detail) {
            ImageHelper::deletePath($detail->image_path, 'public');
        }

        $gallery->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Galeri berhasil dihapus');
        $this->resetPage();
    }
}
