<?php

namespace App\Livewire\Superadmin\Admin\Jadwal;

use App\Models\Jadwal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search = '';

    protected $queryString = ['search', 'paginate'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jadwals = Jadwal::with([
            'guruPelajaran.guru',
            'guruPelajaran.pelajaran',
            'siswaKelas.ruangKelas',
            'siswaKelas.tingkatKelas',
            'siswaKelas.jurusan',
            'waktuJadwal',
        ])
        ->whereHas('guruPelajaran.guru', function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('guruPelajaran.pelajaran', function ($q) {
            $q->where('nama', 'like', '%' . $this->search . '%');
        })
        ->orderBy('hari')
        ->orderBy('waktu_jadwal_id')
        ->paginate($this->paginate);

        return view('livewire.superadmin.admin.jadwal.index', [
            'title' => 'Data Jadwal Pelajaran',
            'jadwals' => $jadwals,
        ])->title('Data Jadwal Pelajaran');
    }
}
