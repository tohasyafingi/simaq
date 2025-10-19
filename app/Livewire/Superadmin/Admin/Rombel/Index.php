<?php

namespace App\Livewire\Superadmin\Admin\Rombel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TingkatKelas;
use App\Models\Jurusan;
use App\Models\RuangKelas;
use App\Models\TahunAjaran;
use App\Models\Rombel;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $tahun_ajaran_id;
    public $tingkat_kelas_id, $jurusan_id, $ruang_kelas_id, $nama;
    public $isEdit = false;
    public $rombelId;
    public $status = 1;

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

    public function render()
    {
        $rombels = Rombel::with(['tingkatKelas', 'jurusan', 'ruangKelas', 'tahunAjaran'])
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.rombel.index', [
            'rombels' => $rombels,
            'tingkatKelas' => TingkatKelas::all(),
            'jurusans' => Jurusan::all(),
            'ruangKelas' => RuangKelas::all(),
            'tahunAjarans' => TahunAjaran::all(),
            'title' => 'Data Rombel',
        ])->title('Data Rombel');
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        // Pastikan tahun_ajaran_id di-set ulang ke aktif setelah reset
        if ($this->tahunAjaranAktif) {
            $this->tahun_ajaran_id = $this->tahunAjaranAktif->id;
        }
    }

    public function store()
    {
        // Validasi input
        $this->validate([
            'nama' => 'required|string|max:255',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'ruang_kelas_id' => 'nullable|exists:ruang_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'status' => 'required|in:0,1',  // validasi status (0 atau 1)
        ]);

        // Debug: Cek nilai yang akan disimpan
        Log::debug('Menyimpan data Rombel', [
            'nama' => $this->nama,
            'tingkat_kelas_id' => $this->tingkat_kelas_id,
            'jurusan_id' => $this->jurusan_id,
            'ruang_kelas_id' => $this->ruang_kelas_id,
            'tahun_ajaran_id' => $this->tahun_ajaran_id,
            'status' => $this->status,
        ]);

        // Menyimpan data ke dalam database
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
        // Validasi input
        $this->validate([
            'nama' => 'required|string|max:255',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'ruang_kelas_id' => 'nullable|exists:ruang_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'status' => 'required|in:0,1',  // validasi status (0 atau 1)
        ]);

        // Mengupdate data Rombel
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

    public function resetForm()
    {
        $this->nama = '';
        $this->tingkat_kelas_id = '';
        $this->jurusan_id = '';
        $this->ruang_kelas_id = '';
        // Jangan reset tahun_ajaran_id, biarkan tetap ke aktif
        // $this->tahun_ajaran_id = '';
        $this->status = 1;  // Default status adalah 1 (Aktif)
    }
}