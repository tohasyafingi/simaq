<?php

namespace App\Livewire\Superadmin\Admin\KatBerita;

use Livewire\Component;
use App\Models\KatBerita;
use Livewire\Attributes\Title;

#[Title('Berita')]
class Index extends Component
{
    public $nama, $slug, $katId;
    public $editMode = false;
    public function render()
    {
        $kategoris = KatBerita::orderBy('created_at', 'desc')->get();

        return view('livewire.superadmin.admin.kat-berita.index', [
            'title' => 'Data Kategori Berita',
            'kategoris' => $kategoris,
        ]);
    }
    public function resetForm()
    {
        $this->nama = '';
        $this->slug = '';
        $this->katId = null;
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kat_beritas,slug,' . $this->katId,
        ]);

        KatBerita::updateOrCreate(
            ['id' => $this->katId],
            ['nama' => $this->nama, 'slug' => $this->slug]
        );

        session()->flash('message', $this->katId ? 'Kategori diperbarui.' : 'Kategori ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $kat = KatBerita::findOrFail($id);
        $this->katId = $kat->id;
        $this->nama = $kat->nama;
        $this->slug = $kat->slug;
        $this->editMode = true;
    }

    public function delete($id)
    {
        KatBerita::findOrFail($id)->delete();
        session()->flash('message', 'Kategori dihapus.');
        $this->resetForm();
    }
}
