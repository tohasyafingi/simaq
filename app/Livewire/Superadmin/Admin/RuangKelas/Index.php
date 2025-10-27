<?php

namespace App\Livewire\Superadmin\Admin\RuangKelas;

use App\Models\RuangKelas;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Data Ruang Kelas')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $kelas_id, $nama, $status;
    public $isEdit = false;

    public function render()
    {
        $ruangKelas = RuangKelas::where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('nama')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.ruang-kelas.index', [
            'title' => 'Data Ruang Kelas',
            'ruangKelas' => $ruangKelas,
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
            'nama'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        RuangKelas::create([
            'nama'   => $this->nama,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Kelas berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = RuangKelas::findOrFail($id);

        $this->kelas_id = $data->id;
        $this->nama = $data->nama;
        $this->status = $data->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = RuangKelas::findOrFail($this->kelas_id);

        $this->validate([
            'nama'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data->update([
            'nama'   => $this->nama,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Kelas berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = RuangKelas::findOrFail($id);
        $this->kelas_id = $id;
    }

    public function destroy()
    {
        $kelas = RuangKelas::findOrFail($this->kelas_id);
        $kelas->delete();

        session()->flash('message', 'Kelas berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nama = null;
        $this->status = null;
        $this->kelas_id = null;
        $this->isEdit = false;
    }
}
