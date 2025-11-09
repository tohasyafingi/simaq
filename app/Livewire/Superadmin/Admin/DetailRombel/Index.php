<?php

namespace App\Livewire\Superadmin\Admin\DetailRombel;

use Livewire\Component;
use App\Models\Rombel;
use App\Models\Siswa;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Detail Rombel')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $rombel;
    public $siswa_id, $status;
    public $search = '';
    public $searchSiswa = '';
    public $paginate = 10;
    public $paginateSiswa = 10;

    public function mount($rombelId)
    {
        $this->rombel = Rombel::with(['tingkatKelas', 'jurusan', 'ruangKelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    public function addSiswa()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        $siswa = Siswa::where('id', $this->siswa_id)
            ->where('status', 'aktif')
            ->first();

        if (!$siswa) {
            session()->flash('message', 'Siswa tidak ditemukan atau tidak aktif.');
            return;
        }

        if ($siswa->isInAnyRombel()) {
            session()->flash('message', 'Siswa sudah tergabung di rombel lain.');
            return;
        }

        $this->rombel->siswa()->attach($this->siswa_id, ['status' => 1]);


        $this->resetInputFields();
        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Siswa berhasil ditambahkan.');
    }

    public function updateStatus($siswa_id, $status)
    {
        $this->rombel->siswa()->updateExistingPivot($siswa_id, ['status' => (bool) $status]);
        session()->flash('message', 'Status siswa berhasil diubah.');
    }

    public function deleteSiswa($siswaId)
    {
        $this->rombel->siswa()->detach($siswaId);
        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Siswa berhasil dihapus.');
    }

    private function resetInputFields()
    {
        $this->siswa_id = '';
        $this->status = '';
    }

    public function updatedSearchSiswa()
    {
        $this->resetPage();
    }

    public function render()
    {
        $siswaList = Siswa::where('status', 'aktif')
            ->whereDoesntHave('rombels')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->paginate);

        $siswaInRombel = $this->rombel->siswa()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchSiswa . '%')
                    ->orWhere('nis', 'like', '%' . $this->searchSiswa . '%');
            })
            ->paginate($this->paginateSiswa);

        return view('livewire.superadmin.admin.detail-rombel.index', [
            'title' => 'Detail Rombel',
            'rombel' => $this->rombel,
            'siswaList' => $siswaList,
            'siswaInRombel' => $siswaInRombel,
        ]);
    }
}
