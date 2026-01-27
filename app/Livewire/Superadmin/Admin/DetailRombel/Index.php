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
    public $siswa_ids = [];

    public function updatedPaginateSiswa()
    {
        $this->resetPage();
    }

    public function mount($rombelId)
    {
        $this->rombel = Rombel::with(['tingkatKelas', 'jurusan', 'ruangKelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    public function addSiswa()
    {
        $this->validate([
            'siswa_ids' => 'required|array|min:1',
            'siswa_ids.*' => 'exists:siswas,id',
        ]);

        $siswas = Siswa::whereIn('id', $this->siswa_ids)
            ->where('status', 'aktif')
            ->get();

        foreach ($siswas as $siswa) {
            if ($siswa->isInAnyRombel()) {
                continue;
            }
            $this->rombel->siswa()->attach($siswa->id, ['status' => 1]);
        }

        $this->resetInputFields();

        $this->dispatch('resetSelect2Siswa');

        $this->dispatch('refreshSelect2');

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
        $this->dispatch('refreshSelect2');
        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Siswa berhasil dihapus.');
    }

    private function resetInputFields()
    {
        $this->siswa_ids = [];
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
            ->orderBy('name')
            ->get();


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
