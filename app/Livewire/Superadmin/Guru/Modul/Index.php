<?php

namespace App\Livewire\Superadmin\Guru\Modul;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modul;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Data Modul Guru')]
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
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        if ($tahunAjaranAktif) {
            $this->tahun_ajaran_id = $tahunAjaranAktif->id;
        }
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

        // Ambil semua pelajaran yang dia ajar
        $pelajaranIds = \App\Models\GuruPelajaran::where('guru_id', $this->gurumodulId)
            ->pluck('pelajaran_id')
            ->toArray();

        $moduls = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])
            ->whereIn('pelajaran_id', $pelajaranIds)
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
        ]);
    }


    public function getModulFilePath($modulId)
    {
        $modul = Modul::find($modulId);
        return $modul ? $modul->file : null;
    }
}
