<?php

namespace App\Livewire\Superadmin\Admin\Berita;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Berita;
use App\Models\KatBerita;
use Livewire\Attributes\Title;

#[Title('Berita')]
class Create extends Component
{
    use WithFileUploads;

    public $beritaId;
    public $judul;
    public $kat_berita_id;
    public $thumbnail;
    public $thumbnailUrl;
    public $status = 1; // 1 = publik/aktif, 0 = privat/draft
    public $isi;

    public $kategoriOptions;

    public function mount($id = null)
    {
        // Ambil semua kategori
        $this->kategoriOptions = KatBerita::all();

        if ($id) {
            $this->beritaId = $id;
            $berita = Berita::findOrFail($id);
            $this->judul = $berita->judul;
            $this->kat_berita_id = $berita->kat_berita_id;
            $this->status = $berita->status;
            $this->isi = $berita->isi;
            $this->thumbnailUrl = $berita->thumbnail_url;
        }
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'kat_berita_id' => 'required|exists:kat_beritas,id',
            'isi' => 'required|string',
            'status' => 'required|boolean',
            'thumbnail' => $this->beritaId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $thumbPath = $this->thumbnailUrl; // default pakai thumbnail lama

        // Simpan thumbnail baru jika ada
        if ($this->thumbnail) {
            $thumbPath = $this->thumbnail->store('berita', 'public');
        }

        $data = [
            'judul' => $this->judul,
            'thumbnail' => $thumbPath,
            'kat_berita_id' => $this->kat_berita_id,
            'status' => $this->status,
            'isi' => $this->isi,
        ];

        Berita::updateOrCreate(
            ['id' => $this->beritaId],
            $data
        );

        session()->flash('message', $this->beritaId ? 'Berita diperbarui.' : 'Berita berhasil ditambahkan.');
        return redirect()->route('superadmin.admin.berita.index');
    }

    public function render()
    {
        return view('livewire.superadmin.admin.berita.create', [
            'title' => $this->beritaId ? 'Edit Berita' : 'Tambah Berita',
        ]);
    }
}
