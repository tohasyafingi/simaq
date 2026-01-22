<?php

namespace App\Livewire\Superadmin\Admin\Pelajaran;

use App\Models\Pelajaran;
use App\Models\Jurusan;
use App\Models\TingkatKelas;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Mata Pelajaran')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $pelajaran_id, $nama, $kd_pelajaran, $jurusan_id, $tingkat_kelas_id, $status;
    public $isEdit = false;

public function render()
{
    $pelajarans = Pelajaran::with(['jurusan', 'tingkatKelas'])
        ->when($this->search, function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('kd_pelajaran', 'like', '%' . $this->search . '%')
                // Pencarian berdasarkan nama jurusan yang terkait dengan pelajaran
                ->orWhereHas('jurusan', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%');
                })
                // Pencarian berdasarkan tingkat kelas yang terkait dengan pelajaran
                ->orWhereHas('tingkatKelas', function ($q) {
                    $q->where('tingkat', 'like', '%' . $this->search . '%');
                });
        })
        ->orderBy('nama') // Mengurutkan hasil pencarian berdasarkan nama
        ->paginate($this->paginate);

    return view('livewire.superadmin.admin.pelajaran.index', [
        'title' => 'Data Mata Pelajaran',
        'pelajarans' => $pelajarans,
        'jurusans' => Jurusan::orderBy('nama')->get(),
        'tingkat_kelas' => TingkatKelas::orderByRaw('CAST(tingkat AS UNSIGNED)')->get(),
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
            'kd_pelajaran' => 'required|string',
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required',
            'tingkat_kelas_id' => 'required',
            'status' => 'required|boolean',
        ]);

        // Resolve jurusan collection (single or all)
        $jurusans = $this->jurusan_id === 'all' ? Jurusan::orderBy('nama')->get() : Jurusan::where('id', $this->jurusan_id)->get();
        // Resolve tingkat collection (single or all)
        $tingkat_kelas = $this->tingkat_kelas_id === 'all' ? TingkatKelas::orderByRaw('CAST(tingkat AS UNSIGNED)')->get() : TingkatKelas::where('id', $this->tingkat_kelas_id)->get();

        // Multiple or single create for combinations of jurusan x tingkat
        $created = 0;
        foreach ($jurusans as $j) {
            foreach ($tingkat_kelas as $tk) {
                // Build kode as input_kode + '_' + jurusan.kode + '_' + tingkat
                $base = trim($this->kd_pelajaran);
                $jurusanKode = isset($j->kode) ? $j->kode : $j->id;
                $tingkatVal = isset($tk->tingkat) ? $tk->tingkat : $tk->id;

                // sanitize: replace spaces with underscore and remove non-alphanumeric except underscore and dash
                $parts = [
                    preg_replace('/[^A-Za-z0-9-_]/', '', str_replace(' ', '_', $base)),
                    preg_replace('/[^A-Za-z0-9-_]/', '', str_replace(' ', '_', $jurusanKode)),
                    preg_replace('/[^A-Za-z0-9-_]/', '', str_replace(' ', '_', $tingkatVal)),
                ];

                $kd = strtoupper(implode('_', array_filter($parts)));

                if (Pelajaran::where('kd_pelajaran', $kd)->exists()) {
                    continue;
                }

                Pelajaran::create([
                    'kd_pelajaran' => $kd,
                    'nama' => $this->nama,
                    'jurusan_id' => $j->id,
                    'tingkat_kelas_id' => $tk->id,
                    'status' => $this->status,
                ]);

                $created++;
            }
        }

        if ($created === 0) {
            $this->addError('kd_pelajaran', 'Tidak ada pelajaran baru yang dibuat (mungkin kode sudah ada).');
            return;
        }

        session()->flash('message', $created . ' pelajaran berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = Pelajaran::findOrFail($id);

        $this->pelajaran_id = $data->id;
        $this->kd_pelajaran = $data->kd_pelajaran;
        $this->nama = $data->nama;
        $this->jurusan_id = $data->jurusan_id;
        $this->tingkat_kelas_id = $data->tingkat_kelas_id;
        $this->status = $data->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = Pelajaran::findOrFail($this->pelajaran_id);

        $this->validate([
            'kd_pelajaran' => 'required|string|unique:pelajarans,kd_pelajaran,' . $data->id,
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
            'status' => 'required|boolean',
        ]);

        $data->update([
            'kd_pelajaran' => $this->kd_pelajaran,
            'nama' => $this->nama,
            'jurusan_id' => $this->jurusan_id,
            'tingkat_kelas_id' => $this->tingkat_kelas_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Pelajaran berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = Pelajaran::findOrFail($id);
        $this->pelajaran_id = $data->id;
        $this->nama = $data->nama;
    }

    public function destroy()
    {
        $data = Pelajaran::findOrFail($this->pelajaran_id);
        $data->delete();

        session()->flash('message', 'Pelajaran berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->kd_pelajaran = null;
        $this->nama = null;
        $this->jurusan_id = null;
        $this->tingkat_kelas_id = null;
        $this->status = null;
        $this->pelajaran_id = null;
        $this->isEdit = false;
    }
}
