<?php

namespace App\Livewire\Superadmin\Admin\WaktuJadwal;

use App\Models\WaktuJadwal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;

    public $waktu_id, $jam_mulai, $jam_selesai;
    public $isEdit = false;

    public function render()
    {
        $waktus = WaktuJadwal::where('jam_mulai', 'like', '%' . $this->search . '%')
            ->orderBy('jam_mulai')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.waktu-jadwal.index', [
            'title' => 'Data Jam Pelajaran',
            'waktus' => $waktus,
        ])->title('Data Jam Pelajaran');
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
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        WaktuJadwal::create([
            'jam_mulai'   => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        session()->flash('message', 'Jam pelajaran berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $this->resetValidation();
        $data = WaktuJadwal::findOrFail($id);

        $this->waktu_id = $data->id;
        $this->jam_mulai = $data->jam_mulai;
        $this->jam_selesai = $data->jam_selesai;
        $this->isEdit = true;
    }

    public function update()
    {
        $data = WaktuJadwal::findOrFail($this->waktu_id);

        $this->validate([
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $data->update([
            'jam_mulai'   => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        session()->flash('message', 'Jam pelajaran berhasil diupdate.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $data = WaktuJadwal::findOrFail($id);
        $this->waktu_id = $id;
    }

    public function destroy()
    {
        $data = WaktuJadwal::findOrFail($this->waktu_id);
        $data->delete();

        session()->flash('message', 'Jam pelajaran berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->jam_mulai = null;
        $this->jam_selesai = null;
        $this->waktu_id = null;
        $this->isEdit = false;
    }
}
