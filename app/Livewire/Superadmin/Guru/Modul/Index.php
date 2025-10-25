<?php

namespace App\Livewire\Superadmin\Guru\Modul;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modul;
use App\Models\TahunAjaran;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $gurumodulId;  
    public $title = 'Modul Guru';
    public $paginate = 10;
    public $search = '';
    public $tahun_ajaran_id;

    protected $updatesQueryString = ['tahun_ajaran_id', 'search', 'paginate'];

    public function mount($gurumodulId)
    {
        $this->gurumodulId = $gurumodulId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTahunAjaranId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('status', 1)->first();

        $moduls = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])
            ->whereHas('pelajaran.guruPelajarans', function ($q) {
                $q->where('guru_id', $this->gurumodulId);
            })
            ->when($this->tahun_ajaran_id, function ($q) {
                $q->whereHas('pelajaran.guruPelajarans', function ($q2) {
                    $q2->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                });
            })
            ->when($this->search, function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama', 'asc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.guru.modul.index', [
            'moduls' => $moduls,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ])->title('Modul Guru');
    }

    public function getModulFilePath($modulId)
    {
        $modul = Modul::find($modulId);
        return $modul ? $modul->file : null;
    }
}