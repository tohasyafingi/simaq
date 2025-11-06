<?php

namespace App\Livewire\Superadmin\Admin\KaryaIlmiah;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\KaryaIlmiah;
use App\Models\KatKaryaIlmiah;
use Livewire\Attributes\Title;

#[Title('Karya Ilmiah')]
class Create extends Component
{
    use WithFileUploads;

    public $karya_ilmiahId;
    public $judul;
    public $kat_karya_ilmiah_id;
    public $thumbnail;
    public $author;
    public $thumbnailUrl;
    public $status = 1; // 1 = Publik, 0 = Draft
    public $isi;

    public $kategoriOptions;

    public function mount($id = null)
    {
        // Ambil semua kategori
        $this->kategoriOptions = KatKaryaIlmiah::all();

        if ($id) {
            $this->karya_ilmiahId = $id;
            $karya = KaryaIlmiah::findOrFail($id);

            $this->judul = $karya->judul;
            $this->author = $karya->author;
            $this->kat_karya_ilmiah_id = $karya->kat_karya_ilmiah_id;
            $this->status = $karya->status;
            $this->isi = $karya->isi;
            $this->thumbnailUrl = $karya->thumbnail_url;
        }
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'kat_karya_ilmiah_id' => 'required|exists:kat_karya_ilmiahs,id',
            'isi' => 'required|string',
            'status' => 'required|boolean',
            'thumbnail' => $this->karya_ilmiahId ? 'nullable|image|max:5120' : 'required|image|max:5120',
        ]);

        $existingThumbnail = $this->karya_ilmiahId ? KaryaIlmiah::find($this->karya_ilmiahId)->thumbnail : null;

        if ($this->thumbnail) {
            $existingThumbnail = $this->thumbnail->store('karya_ilmiah', 'public');
        }

        KaryaIlmiah::updateOrCreate(
            ['id' => $this->karya_ilmiahId],
            [
                'judul' => $this->judul,
                'author' => $this->author,
                'kat_karya_ilmiah_id' => $this->kat_karya_ilmiah_id,
                'status' => $this->status,
                'isi' => $this->isi,
                'thumbnail' => $existingThumbnail,
            ]
        );

        session()->flash('message', $this->karya_ilmiahId ? 'Karya Ilmiah diperbarui.' : 'Karya Ilmiah berhasil ditambahkan.');

        return redirect()->route('superadmin.admin.karya-ilmiah.index');
    }

    public function render()
    {
        return view('livewire.superadmin.admin.karya-ilmiah.create', [
            'title' => $this->karya_ilmiahId ? 'Edit Karya Ilmiah' : 'Tambah Karya Ilmiah',
        ]);
    }
}
