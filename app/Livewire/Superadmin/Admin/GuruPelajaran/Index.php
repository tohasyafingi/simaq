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
    public $guru_id, $pelajaran_id = [], $pengajar_id;
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

        $gurus = Guru::where('status', true)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->whereHas('guruPelajarans', function ($q) {
                if ($this->tahun_ajaran_id) {
                    $q->where('tahun_ajaran_id', $this->tahun_ajaran_id);
                }
                if ($this->search) {
                    $q->whereHas('pelajaran', function ($q2) {
                        $q2->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('kd_pelajaran', 'like', '%' . $this->search . '%');
                    });
                }
            })
            ->with(['guruPelajarans' => function ($q) {
                $q->with(['pelajaran.tingkatKelas', 'pelajaran.jurusan'])
                    ->when($this->tahun_ajaran_id, fn($q2) => $q2->where('tahun_ajaran_id', $this->tahun_ajaran_id));
            }])
            ->orderBy('name')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.guru-pelajaran.index', [
            'title' => 'Data Pengajar',
            'guru_pelajarans' => $gurus,
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
        $this->dispatch('resetSelect2Create');
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'guru_id' => 'required|exists:gurus,id',
            'pelajaran_id' => 'required|array|min:1',
            'pelajaran_id.*' => 'exists:pelajarans,id',
            'status' => 'required|boolean',
        ]);

        if (!$this->tahunAjaranAktif) {
            session()->flash('message', 'Tidak ada tahun ajaran aktif.');
            return;
        }

        foreach ($this->pelajaran_id as $pid) {
            $exists = GuruPelajaran::where('guru_id', $this->guru_id)
                ->where('pelajaran_id', $pid)
                ->where('tahun_ajaran_id', $this->tahunAjaranAktif->id)
                ->exists();

            if (!$exists) {
                GuruPelajaran::create([
                    'guru_id' => $this->guru_id,
                    'pelajaran_id' => $pid,
                    'tahun_ajaran_id' => $this->tahunAjaranAktif->id,
                    'status' => $this->status,
                ]);
            }
        }

        session()->flash('message', 'Pengajar berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->dispatch('resetSelect2Create');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();

        // $id is guru id in grouped view. Load pelajaran ids for selected tahun ajaran
        $this->isEdit = true;
        $this->guru_id = $id;

        $taId = $this->tahun_ajaran_id ?? ($this->tahunAjaranAktif->id ?? null);

        $this->pelajaran_id = GuruPelajaran::where('guru_id', $id)
            ->when($taId, fn($q) => $q->where('tahun_ajaran_id', $taId))
            ->pluck('pelajaran_id')
            ->toArray();

        // set status if any record has status
        $statusRecord = GuruPelajaran::where('guru_id', $id)
            ->when($taId, fn($q) => $q->where('tahun_ajaran_id', $taId))
            ->first();

        $this->status = $statusRecord->status ?? 1;

        // KIRIM DATA KE JS
        $this->dispatch('editModalOpen', [
            'pelajaran_ids' => $this->pelajaran_id
        ]);
    }

    public function update()
    {
        if (!$this->tahunAjaranAktif) {
            session()->flash('message', 'Tidak ada tahun ajaran aktif.');
            return;
        }

        $this->validate([
            'guru_id' => 'required|exists:gurus,id',
            'pelajaran_id' => 'required|array|min:1',
            'pelajaran_id.*' => 'exists:pelajarans,id',
            'status' => 'required|boolean',
        ]);

        // Hapus semua pelajaran lama guru di tahun ajaran aktif
        GuruPelajaran::where('guru_id', $this->guru_id)
            ->where('tahun_ajaran_id', $this->tahunAjaranAktif->id)
            ->delete();

        // Tambahkan ulang pelajaran
        foreach ($this->pelajaran_id as $pid) {
            GuruPelajaran::create([
                'guru_id' => $this->guru_id,
                'pelajaran_id' => $pid,
                'tahun_ajaran_id' => $this->tahunAjaranAktif->id,
                'status' => $this->status,
            ]);
        }

        session()->flash('message', 'Pengajar berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->dispatch('resetSelect2Edit');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        // In grouped view, $id is guru id — confirm deletion of all guru_pelajarans for that guru in selected year
        $this->pengajar_id = null;
        $this->guru_id = $id;
    }

    public function destroy()
    {
        if ($this->pengajar_id) {
            $data = GuruPelajaran::findOrFail($this->pengajar_id);
            $data->delete();
        } elseif ($this->guru_id) {
            $taId = $this->tahun_ajaran_id ?? ($this->tahunAjaranAktif->id ?? null);
            $query = GuruPelajaran::where('guru_id', $this->guru_id);
            if ($taId) $query->where('tahun_ajaran_id', $taId);
            $query->delete();
        }

        session()->flash('message', 'Pengajar berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->guru_id = null;
        $this->pelajaran_id = [];
        $this->pengajar_id = null;
        $this->isEdit = false;
        $this->status = 1;
    }
}
