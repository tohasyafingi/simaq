<?php

namespace App\Livewire\Superadmin\Admin\DetailGuruPengajar;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruPelajaran;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use Livewire\Attributes\Title;

#[Title('Data Mata Pelajaran')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $guru_id;
    public $search = '';
    public $tahun_ajaran_id;
    public $paginate = 10;

    public $tahunAjaranAktif;

    public function mount($guruId)
    {
        $this->guru_id = $guruId;

        $this->tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        if ($this->tahunAjaranAktif) {
            $this->tahun_ajaran_id = $this->tahunAjaranAktif->id;
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTahunAjaranId()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil guru_pelajarans sesuai filter
        $guruPelajarans = GuruPelajaran::with('pelajaran')
            ->where('guru_id', $this->guru_id)
            ->when($this->tahun_ajaran_id, fn($q) => $q->where('tahun_ajaran_id', $this->tahun_ajaran_id))
            ->when($this->search, fn($q) => $q->whereHas(
                'pelajaran',
                fn($q2) =>
                $q2->where('nama', 'like', "%{$this->search}%")
                    ->orWhere('kd_pelajaran', 'like', "%{$this->search}%")
            ))
            ->orderBy('tahun_ajaran_id', 'desc')
            ->paginate($this->paginate);

        // Map guru_pelajarans ke rombel yang tepat
        $pelajarans = $guruPelajarans->map(function ($gp) {
            // Pastikan rombel hanya yang sama tingkat_kelas dengan pelajaran
            $rombels = Rombel::where('tingkat_kelas_id', $gp->pelajaran->tingkat_kelas_id)
                ->when($gp->pelajaran->jurusan_id, fn($q) => $q->where('jurusan_id', $gp->pelajaran->jurusan_id))
                ->where('tahun_ajaran_id', $gp->tahun_ajaran_id)
                ->get();

            return [
                'guru_pelajaran' => $gp,
                'pelajaran' => $gp->pelajaran,
                'rombels' => $rombels,
                'status' => $gp->status,
            ];
        });

        return view('livewire.superadmin.guru.pelajaran.index', [
            'pelajarans' => $pelajarans,
            'guruPelajarans' => $guruPelajarans,
            'tahunAjarans' => TahunAjaran::orderBy('tahun', 'desc')->get(),
            'tahunAjaranAktif' => $this->tahunAjaranAktif,
            'title' => 'Data Mata Pelajaran',
        ]);
    }
}

