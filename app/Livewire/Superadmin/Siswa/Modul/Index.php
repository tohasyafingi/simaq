<?php

namespace App\Livewire\Superadmin\Siswa\Modul;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;
use App\Models\Modul;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Data Modul Siswa')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $siswaId;
    public $paginate = 10;
    public $search = '';
    public $tahun_ajaran_id;

    protected $updatesQueryString = ['tahun_ajaran_id', 'search', 'paginate'];

    public function mount($siswaId)
    {
        $this->siswaId = $siswaId;

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
        $siswa = Siswa::findOrFail($this->siswaId);

        // Ambil rombel siswa sesuai tahun ajaran
        $rombels = $siswa->rombels()
            ->when($this->tahun_ajaran_id, fn($q) => $q->where('rombels.tahun_ajaran_id', $this->tahun_ajaran_id))
            ->with('jurusan', 'tingkatKelas')
            ->get();

        if ($rombels->isEmpty()) {
            $moduls = Modul::whereRaw('0 = 1')->paginate($this->paginate); // kosong jika siswa tidak punya rombel
            $jurusanSiswa = '-';
        } else {
            // Ambil tingkat kelas rombel siswa (bisa lebih dari satu)
            $tingkatKelasIds = $rombels->pluck('tingkat_kelas_id')->unique()->toArray();
            $jurusanSiswa = $rombels->first()->jurusan->nama ?? '-';

            $moduls = Modul::with('pelajaran.tingkatKelas', 'pelajaran.jurusan')
    ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
    ->whereHas('pelajaran', function ($q) use ($tingkatKelasIds, $jurusanSiswa) {
        $q->whereIn('tingkat_kelas_id', $tingkatKelasIds)
          ->whereHas('jurusan', fn($q2) => $q2->where('nama', $jurusanSiswa));
    })
    ->orderBy('nama', 'asc')
    ->paginate($this->paginate);

        }

        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        return view('livewire.superadmin.siswa.modul.index', [
            'title' => 'Modul Siswa',
            'moduls' => $moduls,
            'jurusanSiswa' => $jurusanSiswa,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }
}
