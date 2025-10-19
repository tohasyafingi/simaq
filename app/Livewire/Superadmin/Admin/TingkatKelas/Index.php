<?php

namespace App\Livewire\Superadmin\Admin\TingkatKelas;

use App\Models\TingkatKelas;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $tingkat, $urutan, $status, $tingkat_id;
    public $isEdit = false;

    public function render()
    {
        $data = TingkatKelas::where('tingkat', 'like', '%' . $this->search . '%')
            ->orderBy('urutan')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.tingkat-kelas.index', [
            'title' => 'Data Tingkat Kelas',
            'tingkatKelas' => $data,
        ])->title('Data Tingkat Kelas');
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
            'tingkat' => 'required|string|max:10|unique:tingkat_kelas,tingkat',
            'urutan'  => 'required|integer|min:1',
            'status'  => 'required|boolean',
        ]);

        TingkatKelas::create([
            'tingkat' => $this->tingkat,
            'urutan'  => $this->urutan,
            'status'  => $this->status,
        ]);

        session()->flash('message', 'Tingkat kelas berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = TingkatKelas::findOrFail($id);
        $this->tingkat_id = $data->id;
        $this->tingkat = $data->tingkat;
        $this->urutan = $data->urutan;
        $this->status = $data->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = TingkatKelas::findOrFail($this->tingkat_id);

        $this->validate([
            'tingkat' => 'required|string|max:10|unique:tingkat_kelas,tingkat,' . $data->id,
            'urutan'  => 'required|integer|min:1',
            'status'  => 'required|boolean',
        ]);

        $data->update([
            'tingkat' => $this->tingkat,
            'urutan'  => $this->urutan,
            'status'  => $this->status,
        ]);

        session()->flash('message', 'Tingkat kelas berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = TingkatKelas::findOrFail($id);
        $this->tingkat_id = $data->id;
        $this->tingkat = $data->tingkat;
    }

    public function destroy()
    {
        $data = TingkatKelas::findOrFail($this->tingkat_id);
        $data->delete();

        session()->flash('message', 'Tingkat kelas berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->tingkat = null;
        $this->urutan = null;
        $this->status = null;
        $this->tingkat_id = null;
        $this->isEdit = false;
    }
}
