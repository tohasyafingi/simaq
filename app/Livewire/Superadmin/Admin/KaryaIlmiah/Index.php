<?php

namespace App\Livewire\Superadmin\Admin\KaryaIlmiah;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KaryaIlmiah;
use Livewire\Attributes\Title;

#[Title('Karya Ilmiah')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;

    protected $updatesQueryString = ['search', 'paginate'];

    public function updatingSearch()
    {
        $this->resetPage(); // Reset halaman saat search berubah
    }

    public function edit($id)
    {
        return redirect()->route('superadmin.admin.karya-ilmiah.edit', ['id' => $id]);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $id]);
    }

    public function render()
    {
        $karya_ilmiahs = KaryaIlmiah::with('kategori')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.karya-ilmiah.index', [
            'title' => 'Data Karya Ilmiah',
            'karya_ilmiahs' => $karya_ilmiahs,
        ]);
    }
}
