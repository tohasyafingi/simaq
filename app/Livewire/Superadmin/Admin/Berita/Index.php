<?php

namespace App\Livewire\Superadmin\Admin\Berita;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Models\Berita;

#[Title('Berita')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ================= PROPERTIES ================= */

    public $title    = 'Data Berita';
    public $search   = '';
    public $paginate = 12;

    public $deleteId = null;

    protected $updatesQueryString = ['search', 'paginate'];

    /* ================= LIFECYCLE ================= */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ================= RENDER ================= */

    public function render()
    {
        $beritas = Berita::with('kategori')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.berita.index', [
            'title'   => $this->title,
            'beritas' => $beritas,
        ]);
    }

    /* ================= ACTION ================= */

    public function edit($id)
    {
        return redirect()->route(
            'superadmin.admin.berita.edit',
            ['id' => $id]
        );
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $berita = Berita::findOrFail($this->deleteId);
        $berita->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Berita berhasil dihapus.');

        $this->deleteId = null;
        $this->resetPage();
    }
}
