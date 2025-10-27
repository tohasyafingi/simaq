<?php

namespace App\Livewire\Superadmin\Admin\GuruModul;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Data Guru')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';
    public $tahun_ajaran_id;

    protected $updatesQueryString = ['tahun_ajaran_id', 'search', 'paginate'];

    public function mount()
    {
        // Set default tahun ajaran aktif
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

        $gurus = Guru::with(['guruPelajarans'])
            ->when($this->tahun_ajaran_id, function ($query) {
                $query->whereHas('guruPelajarans', function ($q) {
                    $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                });
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.guru-modul.index', [
            'title' => 'Daftar Guru',
            'gurus' => $gurus,
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $tahunAjaranAktif,
        ]);
    }
}
