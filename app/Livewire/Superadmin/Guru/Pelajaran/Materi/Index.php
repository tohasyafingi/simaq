<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Materi;
use App\Models\GuruPelajaran;
use App\Models\Rombel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $guruPelajaranId;
    public $rombelId;
    public $deleteId;
    public $search = '';
    public $paginate = 10;

    public function mount($guruPelajaranId, $rombelId)
    {
        $this->guruPelajaranId = $guruPelajaranId;
        $this->rombelId = $rombelId;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }
    public function destroy()
    {
        $materis = Materi::findOrFail($this->deleteId);

        $materis->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Materi berhasil dihapus.');
        $this->deleteId = null;
    }

    public function render()
    {
        $query = Materi::with(['guruPelajaran', 'rombel'])
            ->where('guru_pelajaran_id', $this->guruPelajaranId)
            ->where('rombel_id', $this->rombelId)
            ->when($this->search, function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc'); 

        $materis = $query->paginate($this->paginate);

        return view('livewire.superadmin.guru.pelajaran.materi.index', [
            'materis' => $materis,
            'title' => 'Data Materi Rombel ' . Rombel::find($this->rombelId)->nama ?? 'Tidak Ditemukan',
        ])->title('Data Materi');
    }
}
