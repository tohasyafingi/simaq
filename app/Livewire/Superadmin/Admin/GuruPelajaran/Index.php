<?php

namespace App\Livewire\Superadmin\Admin\GuruPelajaran;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GuruPelajaran;
use App\Models\Guru;
use App\Models\Pelajaran;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Data Pengajar')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;

    public $tahun_ajaran_id;
    public $guru_id, $pelajaran_id, $pengajar_id;
    public $isEdit = false;

    public $tahunAjaranAktif;
    public $status = 1;

    public function mount()
    {
        $this->tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        if ($this->tahunAjaranAktif) {
            $this->tahun_ajaran_id = $this->tahunAjaranAktif->id;
        }
    }

    public function render()
    {
        $tahunAjarans = TahunAjaran::orderByDesc('id')->get();

        $data = GuruPelajaran::with(['guru', 'pelajaran.tingkatKelas', 'pelajaran.jurusan', 'tahunAjaran'])
            ->join('gurus', 'gurus.id', '=', 'guru_pelajarans.guru_id')  // Join dengan tabel guru
            ->when($this->tahun_ajaran_id, function ($query) {
                $query->where('tahun_ajaran_id', $this->tahun_ajaran_id);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('guru', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('pelajaran', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('pelajaran.tingkatKelas', function ($q) {
                        $q->where('tingkat', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('pelajaran.jurusan', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('gurus.name')  // Urutkan berdasarkan nama guru (A-Z)
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.guru-pelajaran.index', [
            'title' => 'Data Pengajar',
            'guru_pelajarans' => $data,
            'gurus' => Guru::where('status', true)->get(),
            'pelajarans' => Pelajaran::with('jurusan.tingkat')->where('status', true)->get(),
            'tahunAjarans' => $tahunAjarans,
            'tahunAjaranAktif' => $this->tahunAjaranAktif,
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'guru_id' => 'required|exists:gurus,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'status' => 'required|boolean',
        ]);

        if (!$this->tahunAjaranAktif) {
            session()->flash('message', 'Tidak ada tahun ajaran aktif saat ini.');
            return;
        }

        if (GuruPelajaran::where('guru_id', $this->guru_id)
            ->where('pelajaran_id', $this->pelajaran_id)
            ->where('tahun_ajaran_id', $this->tahunAjaranAktif->id)
            ->exists()
        ) {
            $this->addError('guru_id', 'Kombinasi guru dan pelajaran sudah terdaftar di tahun ajaran ini.');
            return;
        }

        GuruPelajaran::create([
            'guru_id' => $this->guru_id,
            'pelajaran_id' => $this->pelajaran_id,
            'tahun_ajaran_id' => $this->tahunAjaranAktif->id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pengajar berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = GuruPelajaran::findOrFail($id);

        $this->pengajar_id = $data->id;
        $this->guru_id = $data->guru_id;
        $this->pelajaran_id = $data->pelajaran_id;
        $this->status = $data->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = GuruPelajaran::findOrFail($this->pengajar_id);

        $this->validate([
            'guru_id' => 'required|exists:gurus,id',
            'pelajaran_id' => 'required|exists:pelajarans,id',
        ]);

        if (GuruPelajaran::where('guru_id', $this->guru_id)
            ->where('pelajaran_id', $this->pelajaran_id)
            ->where('tahun_ajaran_id', $data->tahun_ajaran_id)
            ->where('id', '!=', $this->pengajar_id)
            ->exists()
        ) {
            $this->addError('guru_id', 'Kombinasi guru dan pelajaran sudah terdaftar di tahun ajaran ini.');
            return;
        }

        $data->update([
            'guru_id' => $this->guru_id,
            'pelajaran_id' => $this->pelajaran_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pengajar berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = GuruPelajaran::findOrFail($id);
        $this->pengajar_id = $data->id;
    }

    public function destroy()
    {
        $data = GuruPelajaran::findOrFail($this->pengajar_id);
        $data->delete();

        session()->flash('message', 'Pengajar berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->guru_id = null;
        $this->pelajaran_id = null;
        $this->pengajar_id = null;
        $this->isEdit = false;
        $this->status = 1;
    }
}
