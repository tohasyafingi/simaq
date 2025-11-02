<?php

namespace App\Livewire\Superadmin\Admin\SiswaModul;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;
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
        $siswas = Siswa::with(['rombels.moduls'])
            ->when($this->tahun_ajaran_id, function ($query) {
                $query->whereHas('rombels', function ($q) {
                    $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                });
            })
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('name')
            ->paginate($this->paginate);

        // Hitung jumlah modul per siswa dan ambil nama rombel
        foreach ($siswas as $siswa) {
            $jumlahPelajaran = 0;

            // Ambil rombel siswa sesuai tahun ajaran aktif
            $rombelsAktif = $siswa->rombels->where('tahun_ajaran_id', $this->tahun_ajaran_id);

            foreach ($rombelsAktif as $rombel) {
                // Modul sesuai tingkat kelas rombel dan jurusan rombel
                $jumlahPelajaran += \App\Models\Modul::whereHas('pelajaran', function ($q) use ($rombel) {
                    $q->where('tingkat_kelas_id', $rombel->tingkat_kelas_id)
                        ->where('jurusan_id', $rombel->jurusan_id);
                })->count();
            }

            $siswa->jumlahPelajaran = $jumlahPelajaran;
            $siswa->namaRombel = $rombelsAktif->pluck('nama')->join(', ');
        }


        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        return view('livewire.superadmin.admin.siswa-modul.index', [
            'title' => 'Daftar Siswa',
            'siswas' => $siswas,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }
}
