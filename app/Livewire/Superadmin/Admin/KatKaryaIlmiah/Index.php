<?php

namespace App\Livewire\Superadmin\Admin\KatKaryaIlmiah;

use Livewire\Component;
use App\Models\KatKaryaIlmiah;
use Livewire\Attributes\Title;

#[Title('Karya Ilmiah')]
class Index extends Component
{
    public $nama, $slug, $katId;
    public $editMode = false;
    public function render()
    {
        $kategoris = KatKaryaIlmiah::orderBy('created_at', 'desc')->get();

        return view('livewire.superadmin.admin.kat-karya-ilmiah.index', [
            'title' => 'Data Kategori Karya Ilmiah',
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
            'slug' => 'required|string|max:255|unique:kat_karya_ilmiahs,slug,' . $this->katId,
        ]);

        KatKaryaIlmiah::updateOrCreate(
            ['id' => $this->katId],
            ['nama' => $this->nama, 'slug' => $this->slug]
        );

        session()->flash('message', $this->katId ? 'Kategori diperbarui.' : 'Kategori ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $kat = KatKaryaIlmiah::findOrFail($id);
        $this->katId = $kat->id;
        $this->nama = $kat->nama;
        $this->slug = $kat->slug;
        $this->editMode = true;
    }

    public function delete($id)
    {
        KatKaryaIlmiah::findOrFail($id)->delete();
        session()->flash('message', 'Kategori dihapus.');
        $this->resetForm();
    }
}
