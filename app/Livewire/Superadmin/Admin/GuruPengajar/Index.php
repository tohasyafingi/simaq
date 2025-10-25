<?php

namespace App\Livewire\Superadmin\Admin\GuruPengajar;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guru;
use App\Models\TahunAjaran;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $tahun_ajaran_id;
    public $search = '';

    protected $updatesQueryString = ['tahun_ajaran_id', 'search', 'paginate'];

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
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        $gurus = Guru::with(['guruPelajarans.pelajaran'])
            ->when($this->tahun_ajaran_id, function ($query) {
                $query->whereHas('guruPelajarans', function ($q) {
                    $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                });
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate($this->paginate);

        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();

        return view('livewire.superadmin.admin.guru-pengajar.index', [
            'title' => 'Data Guru Pengajar',
            'gurus' => $gurus,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ])->title('Data Guru Pengajar');
    }
}
