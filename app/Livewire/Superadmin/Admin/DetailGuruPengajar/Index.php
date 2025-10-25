<?php

namespace App\Livewire\Superadmin\Admin\DetailGuruPengajar;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruPelajaran; 
use App\Models\TahunAjaran;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $guru_id;          
    public $search = '';      
    public $tahun_ajaran_id;  
    public $paginate = 10;

    public function mount($guruId)
    {
        $this->guru_id = $guruId;
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
        $query = GuruPelajaran::with(['pelajaran', 'rombels', 'tahunAjaran'])
            ->where('guru_id', $this->guru_id)
            ->when($this->tahun_ajaran_id, function ($q) {
                $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
            })
            ->whereHas('pelajaran', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('kd_pelajaran', 'like', '%' . $this->search . '%');
            });

        $guruPelajarans = $query->get(); 

        $pelajarans = collect();
        foreach ($guruPelajarans as $gp) {
            foreach ($gp->rombels as $rombel) {
                $pelajarans->push([
                    'guru_pelajaran_id' => $gp->id,
                    'pelajaran' => $gp->pelajaran,
                    'rombel' => $rombel,
                    'status' => $gp->status,
                ]);
            }
        }

        $page = request()->get('page', 1);
        $perPage = $this->paginate;
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $pelajarans->forPage($page, $perPage),
            $pelajarans->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();

        return view('livewire.superadmin.admin.detail-guru-pengajar.index', [
            'pelajarans' => $paginated,
            'tahunAjaranAktif' => $tahunAjaranAktif,
            'tahunAjarans' => $tahunAjarans,
            'title' => 'Data Mata Pelajaran',
        ])->title('Data Mata Pelajaran');
    }
}
