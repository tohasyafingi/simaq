<?php

namespace App\Livewire\Superadmin\Admin\Berita;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Berita;
use App\Models\KatBerita;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

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
            'status' => 'required|in:0,1',
            'thumbnail' => $this->beritaId
                ? 'nullable|file|mimes:webp,jpg,jpeg,png,avif,svg,gif|max:5120'
                : 'required|file|mimes:webp,jpg,jpeg,png,avif,svg,gif|max:5120',
        ]);

        $berita = $this->beritaId
            ? Berita::findOrFail($this->beritaId)
            : new Berita();

        $oldContent = $this->beritaId ? $berita->isi : null;

        // Thumbnail
        if ($this->thumbnail) {
            $berita->thumbnail = ImageHelper::replaceOptimized(
                $berita->thumbnail,
                $this->thumbnail,
                'berita',
                $this->judul,
                'public'
            );
        }

        $berita->judul = $this->judul;
        $berita->slug  = Str::slug($this->judul); // 🔥 WAJIB
        $berita->kat_berita_id = $this->kat_berita_id;
        $berita->status = (int) $this->status;
        $berita->isi = $this->isi;
        $berita->save();

        if ($this->beritaId) {
            ImageHelper::deleteUnusedFromHtml($oldContent, $this->isi);
        }

        return redirect()->route('superadmin.admin.berita.index');
    }


    public function render()
    {
        return view('livewire.superadmin.admin.berita.create', [
            'title' => $this->beritaId ? 'Edit Berita' : 'Tambah Berita',
        ]);
    }
}
