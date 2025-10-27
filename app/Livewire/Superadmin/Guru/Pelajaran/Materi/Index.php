<?php

namespace App\Livewire\Superadmin\Guru\Pelajaran\Materi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Materi;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use Livewire\Attributes\Title;

#[Title('Data materi')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $guruPelajaranId;
    public $rombelId;
    public $deleteId;
    public $tahun_ajaran_id;
    public $search = '';
    public $paginate = 10;

    public function mount($guruPelajaranId, $rombelId)
    {
        $this->guruPelajaranId = $guruPelajaranId;
        $this->rombelId = $rombelId;

        // Set default tahun ajaran aktif
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        $this->tahun_ajaran_id = $tahunAjaranAktif->id ?? null;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTahunAjaranId()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $materi = Materi::findOrFail($this->deleteId);
        $materi->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Materi berhasil dihapus.');
        $this->deleteId = null;
    }

    public function render()
    {
        $tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        $tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();

        $query = Materi::with(['guruPelajaran', 'rombel']);

        if ($this->guruPelajaranId) {
            $query->where('guru_pelajaran_id', $this->guruPelajaranId);
        }

        if ($this->rombelId) {
            $query->where('rombel_id', $this->rombelId);
        }

        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        // Filter berdasarkan tahun ajaran
        $filterTA = $this->tahun_ajaran_id ?? $tahunAjaranAktif->id ?? null;
        if ($filterTA) {
            $query->whereHas('guruPelajaran', function ($q) use ($filterTA) {
                $q->where('tahun_ajaran_id', $filterTA);
            });
        }

        $materis = $query->orderBy('created_at', 'desc')->paginate($this->paginate);

        return view('livewire.superadmin.guru.pelajaran.materi.index', [
            'materis' => $materis,
            'tahunAjaranAktif' => $tahunAjaranAktif,
            'tahunAjarans' => $tahunAjarans,
            'title' => 'Data Materi Rombel ' . (optional(Rombel::find($this->rombelId))->nama ?? 'Tidak Ditemukan'),
        ]);
    }
}
