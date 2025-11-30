<?php

namespace App\Livewire\Superadmin\Admin\TahunAjaran;

use Livewire\Component;
use App\Models\TahunAjaran;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Tahun Ajaran')]
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $tahun, $semester = 'Ganjil', $status = 1, $tahunAjaranId;

    public function render()
    {
        $query = TahunAjaran::query();

        if ($this->search) {
            $query->where('tahun', 'like', '%' . $this->search . '%')
                ->orWhere('semester', 'like', '%' . $this->search . '%');
        }

        return view('livewire.superadmin.admin.tahun-ajaran.index', [
            'title' => 'Data Tahun Ajaran',
            'tahunAjarans' => $query->orderByDesc('id')->paginate($this->paginate),
        ]);
    }

    public function create()
    {
        $this->reset(['tahun', 'semester', 'status']);
    }

    public function store()
    {
        $this->validate([
            'tahun' => 'required|string|max:255',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'required|boolean',
        ]);

        // Jika status aktif, nonaktifkan yang lain
        if ($this->status) {
            TahunAjaran::query()->update(['status' => false]);
        }

        TahunAjaran::create([
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Tahun Ajaran berhasil ditambahkan.');

        $this->reset(['tahun', 'semester', 'status']);

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        $this->tahunAjaranId = $tahunAjaran->id;
        $this->tahun = $tahunAjaran->tahun;
        $this->semester = $tahunAjaran->semester;
        $this->status = $tahunAjaran->status;
    }

    public function update()
    {
        $this->validate([
            'tahun' => 'required|string|max:255',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'required|boolean',
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($this->tahunAjaranId);

        if ($this->status) {
            TahunAjaran::query()->update(['status' => false]);
        }

        $tahunAjaran->update([
            'tahun' => $this->tahun,
            'semester' => $this->semester,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Tahun Ajaran berhasil diperbarui.');

        $this->reset(['tahun', 'semester', 'status', 'tahunAjaranId']);

        $this->dispatch('closeEditModal');
    }

    public function confirmDelete($id)
    {
        $this->tahunAjaranId = $id;
    }

    public function destroy()
    {
        $tahunAjaran = TahunAjaran::findOrFail($this->tahunAjaranId);

        // Cek relasi agar tidak error 1451
        if ($tahunAjaran->rombels()->exists()) {
            $this->dispatch('deleteFailed', 'Tidak dapat menghapus karena Tahun Ajaran masih digunakan pada data Rombel.');
            return;
        }

        $tahunAjaran->delete();

        $this->dispatch('closeDeleteModal'); // sukses
    }
}
