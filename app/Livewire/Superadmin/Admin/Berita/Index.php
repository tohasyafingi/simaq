<?php

namespace App\Livewire\Superadmin\Admin\Berita;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Berita;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $paginate = 10;

    protected $updatesQueryString = ['search', 'paginate'];

    public function updatingSearch()
    {
        $this->resetPage(); // reset halaman saat search berubah
    }

    public function render()
    {
        $beritas = Berita::with('kategori')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.berita.index', [
            'title' => 'Data Berita',
            'beritas' => $beritas,
        ])->title('Berita');
    }
public function edit($id)
{
    return redirect()->route('superadmin.admin.berita.edit', ['id' => $id]);
}


    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $id]);
    }
}
