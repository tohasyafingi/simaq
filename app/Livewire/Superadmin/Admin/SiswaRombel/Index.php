<?php

namespace App\Livewire\Superadmin\Admin\SiswaRombel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Data Siswa')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $tahun_ajaran_id;
    public $search = '';

    protected $updatesQueryString = ['tahun_ajaran_id', 'search', 'paginate'];

    public function mount()
    {
        // Set tahun ajaran aktif sebagai default
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
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $siswas = Siswa::with(['rombels.tingkatKelas', 'rombels.jurusan'])
            ->when($this->tahun_ajaran_id, function ($query) {
                $query->whereHas('rombels', function ($q) {
                    $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                });
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate($this->paginate);

        // Hitung jumlah pelajaran per siswa (berdasarkan rombel)
        foreach ($siswas as $siswa) {
            $rombelAktif = $siswa->rombels()
                ->when($this->tahun_ajaran_id, fn($q) => $q->where('tahun_ajaran_id', $this->tahun_ajaran_id))
                ->first();

            $siswa->namaRombel = $rombelAktif->nama ?? '-';

            if ($rombelAktif) {
                $jumlahPelajaran = \App\Models\Pelajaran::where('tingkat_kelas_id', $rombelAktif->tingkat_kelas_id)
                    ->where(function ($q) use ($rombelAktif) {
                        $q->whereNull('jurusan_id')->orWhere('jurusan_id', $rombelAktif->jurusan_id);
                    })
                    ->count();
            } else {
                $jumlahPelajaran = 0;
            }

            $siswa->jumlahPelajaran = $jumlahPelajaran;
        }

        return view('livewire.superadmin.admin.siswa-rombel.index', [
            'title' => 'Data Siswa',
            'siswas' => $siswas,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }
}

