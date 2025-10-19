<?php

namespace App\Livewire\Superadmin\Admin\Jurusan;

use App\Models\Jurusan;
use App\Models\TingkatKelas;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;
    public $kode, $nama, $status, $jurusan_id;
    public $isEdit = false;

    public function render()
    {
        $data = Jurusan::where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('nama')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.jurusan.index', [
            'title' => 'Data Jurusan',
            'jurusans' => $data,
        ])->title('Data Jurusan');
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
            'kode'   => 'required|string|max:10|unique:jurusans,kode',
            'nama'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        Jurusan::create([
            'kode'       => $this->kode,
            'nama'       => $this->nama,
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Jurusan berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = Jurusan::findOrFail($id);

        $this->jurusan_id = $data->id;
        $this->kode = $data->kode;
        $this->nama = $data->nama;
        $this->status = $data->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = Jurusan::findOrFail($this->jurusan_id);

        $this->validate([
            'kode'   => 'required|string|max:10|unique:jurusans,kode,' . $data->id,
            'nama'   => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        $data->update([
            'kode'       => $this->kode,
            'nama'       => $this->nama,
            'status'     => $this->status,
        ]);

        session()->flash('message', 'Jurusan berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = Jurusan::findOrFail($id);
        $this->jurusan_id = $data->id;
        $this->nama = $data->nama;
    }

    public function destroy()
    {
        $data = Jurusan::findOrFail($this->jurusan_id);
        $data->delete();

        session()->flash('message', 'Jurusan berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->kode = null;
        $this->nama = null;
        $this->status = null;
        $this->jurusan_id = null;
        $this->isEdit = false;
    }
}
