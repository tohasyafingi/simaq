<?php

namespace App\Livewire\Superadmin\Admin\Modul;

use Livewire\Component;
use App\Models\Modul;
use App\Models\Pelajaran;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    protected $paginationTheme = 'bootstrap';

    public $title = 'Modul';
    public $paginate = 10, $search;
    public $modul_id, $nama, $pelajaran_id, $link, $file, $status;
    public $pelajarans;
    public $pelajaran_nama, $tingkat_nama, $jurusan_nama;


    public function mount()
    {
        $this->pelajarans = Pelajaran::where('status', 1)->get();
    }

    public function render()
    {
        $moduls = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('nama')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.modul.index', [
            'moduls' => $moduls,
            'title' => $this->title
        ])->title('Modul Pelajaran');
    }

    public function resetForm()
    {
        $this->reset(['modul_id', 'nama', 'pelajaran_id', 'link', 'file', 'status']);
    }

    public function create()
    {
        $this->resetForm();
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'pelajaran_id' => 'required',
            'link' => 'nullable|url',
            'file' => 'nullable|file',
            'status' => 'required',
        ]);

        if ($this->file) {
            $filePath = $this->file->store('moduls', 'public'); // simpan di storage/app/public/moduls
        } else {
            $filePath = null;
        }

        Modul::create([
            'nama' => $this->nama,
            'pelajaran_id' => $this->pelajaran_id,
            'link' => $this->link,
            'file' => $filePath,
            'status' => $this->status,
        ]);


        session()->flash('message', 'Modul berhasil ditambahkan.');
        $this->dispatch('closeCreateModal');
        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Modul::findOrFail($id);
        $this->modul_id = $id;
        $this->nama = $data->nama;
        $this->pelajaran_id = $data->pelajaran_id;
        $this->link = $data->link;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'pelajaran_id' => 'required',
            'link' => 'nullable|url',
            'file' => 'nullable|file',
            'status' => 'required',
        ]);

        $modul = Modul::findOrFail($this->modul_id);

        if ($this->file) {
            // upload file baru
            $filePath = $this->file->store('moduls', 'public');
        } else {
            // jika tidak upload file baru, gunakan file lama
            $filePath = $modul->file;
        }

        $modul->update([
            'nama' => $this->nama,
            'pelajaran_id' => $this->pelajaran_id,
            'link' => $this->link,
            'file' => $filePath,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Modul berhasil diperbarui.');
        $this->dispatch('closeEditModal');
        $this->resetForm();
    }
    public function getModulFilePath()
    {
        if (!$this->modul_id) return null;

        $modul = Modul::find($this->modul_id);
        return $modul ? $modul->file : null;
    }

    public function confirmDelete($id)
    {
        $modul = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])->findOrFail($id);
        $this->modul_id = $id;
        $this->nama = $modul->nama;
        $this->pelajaran_nama = $modul->pelajaran->nama ?? '-';
        $this->tingkat_nama = $modul->pelajaran->tingkatKelas->tingkat ?? '-';
        $this->jurusan_nama = $modul->pelajaran->jurusan->nama ?? '-';
    }

    public function destroy()
    {
        $modul = Modul::findOrFail($this->modul_id);
        $modul->delete();

        session()->flash('message', 'Modul berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }
}
