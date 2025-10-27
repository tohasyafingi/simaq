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
    public $search = '';  // Properti pencarian siswa berdasarkan nama atau NIS
    public $searchSiswa = '';
    public $paginate = 10;
    public $paginateSiswa = 10;

    // Mengambil ID rombel dari URL
    public function mount($rombelId)
    {
        $this->rombel = Rombel::with(['tingkatKelas', 'jurusan', 'ruangKelas', 'tahunAjaran'])->findOrFail($rombelId);
    }

    // Menambahkan siswa ke rombel
    public function addSiswa()
    {
        $this->validate([
            'siswa_id' => 'required|exists:siswas,id',
        ]);

        $siswa = Siswa::find($this->siswa_id);

        if ($siswa->isInAnyRombel()) {
            session()->flash('message', 'Siswa sudah tergabung di rombel lain.');
            return;
        }

        $this->rombel->siswa()->attach($this->siswa_id, ['status' => 1]);  // Status 1 = Aktif

        $this->resetInputFields();
        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Siswa berhasil ditambahkan.');
    }

    // Update status siswa
    public function updateStatus($siswa_id, $status)
    {
        $this->rombel->siswa()->updateExistingPivot($siswa_id, ['status' => (bool) $status]);
        session()->flash('message', 'Status siswa berhasil diubah.');
    }

    // Menghapus siswa dari rombel
    public function deleteSiswa($siswaId)
    {
        $this->rombel->siswa()->detach($siswaId);
        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Siswa berhasil dihapus.');
    }

    // Reset input fields
    private function resetInputFields()
    {
        $this->siswa_id = '';
        $this->status = '';
    }

    // Reset pagination saat search berubah
    public function updatedSearchSiswa()
    {
        $this->resetPage(); // Reset pagination ke halaman pertama saat pencarian berubah
    }

    // Render view
    public function render()
    {
        // Menampilkan siswa yang belum ada di rombel
        $siswaList = Siswa::whereDoesntHave('rombels') // Hanya siswa yang belum masuk rombel manapun
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->paginate); // Pagination sesuai pilihan user

        // Menampilkan siswa yang sudah ada di rombel
        $siswaInRombel = $this->rombel->siswa()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchSiswa . '%')
                    ->orWhere('nis', 'like', '%' . $this->searchSiswa . '%');
            })
            ->paginate($this->paginateSiswa); // Pagination untuk siswa di rombel

        return view('livewire.superadmin.admin.detail-rombel.index', [
            'title' => 'Detail Rombel',
            'rombel' => $this->rombel,
            'siswaList' => $siswaList,
            'siswaInRombel' => $siswaInRombel,
        ]);
    }
}
