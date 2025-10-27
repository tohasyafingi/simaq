<?php

namespace App\Livewire\Superadmin\Admin\Rombel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TingkatKelas;
use App\Models\Jurusan;
use App\Models\RuangKelas;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use Livewire\Attributes\Title;

#[Title('Data Rombel')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $tahun_ajaran_id;
    public $tingkat_kelas_id;
    public $jurusan_id;
    public $ruang_kelas_id;
    public $nama;
    public $status = 1;
    public $rombelId;
    public $isEdit = false;

    public $tahunAjaranAktif;

    public function mount()
    {
        $this->tahunAjaranAktif = TahunAjaran::where('status', true)->first();

        if ($this->tahunAjaranAktif) {
            $this->tahun_ajaran_id = $this->tahunAjaranAktif->id;
        } else {
            session()->flash('error', 'Tidak ada tahun ajaran aktif.');
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $rombels = Rombel::with(['tingkatKelas', 'jurusan', 'ruangKelas', 'tahunAjaran'])
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->tahun_ajaran_id, fn($q) => $q->where('tahun_ajaran_id', $this->tahun_ajaran_id))
            ->orderBy('tahun_ajaran_id', 'desc')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.rombel.index', [
            'rombels' => $rombels,
            'tingkatKelas' => TingkatKelas::all(),
            'jurusans' => Jurusan::all(),
            'ruangKelas' => RuangKelas::all(),
            'tahunAjarans' => TahunAjaran::orderBy('tahun', 'desc')->orderBy('semester', 'desc')->get(),
            'title' => 'Data Rombel',
        ]);
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->tingkat_kelas_id = '';
        $this->jurusan_id = '';
        $this->ruang_kelas_id = '';
        $this->status = 1;
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'ruang_kelas_id' => 'nullable|exists:ruang_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'status' => 'required|in:0,1',
        ]);

        Rombel::create([
            'nama' => $this->nama,
            'tingkat_kelas_id' => $this->tingkat_kelas_id,
            'jurusan_id' => $this->jurusan_id,
            'ruang_kelas_id' => $this->ruang_kelas_id,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan!');
        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $rombel = Rombel::findOrFail($id);
        $this->rombelId = $rombel->id;
        $this->nama = $rombel->nama;
        $this->tingkat_kelas_id = $rombel->tingkat_kelas_id;
        $this->jurusan_id = $rombel->jurusan_id;
        $this->ruang_kelas_id = $rombel->ruang_kelas_id;
        $this->tahun_ajaran_id = $rombel->tahun_ajaran_id;
        $this->status = $rombel->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'ruang_kelas_id' => 'nullable|exists:ruang_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'status' => 'required|in:0,1',
        ]);

        $rombel = Rombel::findOrFail($this->rombelId);
        $rombel->update([
            'nama' => $this->nama,
            'tingkat_kelas_id' => $this->tingkat_kelas_id,
            'jurusan_id' => $this->jurusan_id,
            'ruang_kelas_id' => $this->ruang_kelas_id,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Data berhasil diperbarui!');
        $this->dispatch('closeEditModal');
    }

    public function confirmDelete($id)
    {
        $this->rombelId = $id;
    }

    public function destroy()
    {
        Rombel::findOrFail($this->rombelId)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        $this->dispatch('closeDeleteModal');
    }
}
