<?php

namespace App\Livewire\Superadmin\Admin\KaryaIlmiah;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Models\KaryaIlmiah;

#[Title('Karya Ilmiah')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ================= PROPERTIES ================= */

    public $title    = 'Data Karya Ilmiah';
    public $search   = '';
    public $paginate = 10;

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
        $karya_ilmiahs = KaryaIlmiah::with('kategori')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.karya-ilmiah.index', [
            'title'          => $this->title,
            'karya_ilmiahs'  => $karya_ilmiahs,
        ]);
    }

    /* ================= ACTION ================= */

    public function edit($id)
    {
        return redirect()->route(
            'superadmin.admin.karya-ilmiah.edit',
            ['id' => $id]
        );
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $karya = KaryaIlmiah::findOrFail($this->deleteId);
        $karya->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Karya ilmiah berhasil dihapus.');

        $this->deleteId = null;
        $this->resetPage();
    }
}
