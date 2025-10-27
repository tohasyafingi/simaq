<?php

namespace App\Livewire\Superadmin\Admin\Modul;

use Livewire\Component;
use App\Models\Modul;
use App\Models\Pelajaran;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\TahunAjaran;
use Livewire\Attributes\Title;

#[Title('Modul Pelajaran')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Modul';
    public $paginate = 10;
    public $search = '';
    public $modul_id, $nama, $pelajaran_id, $link, $file, $status = 1;
    public $pelajarans;
    public $pelajaran_nama, $tingkat_nama, $jurusan_nama;
    public $tahunAjarans;
    public $tahunAjaranAktif;

    public function mount()
    {
        $this->pelajarans = Pelajaran::where('status', 1)->get();
        $this->tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();
        $this->tahunAjaranAktif = TahunAjaran::where('status', true)->first();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

public function render()
{
    $moduls = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])
        ->when($this->search, function ($query) {
            // Pencarian berdasarkan nama modul
            $query->where('nama', 'like', '%' . $this->search . '%')

                // Pencarian berdasarkan nama pelajaran
                ->orWhereHas('pelajaran', function ($q2) {
                    $q2->where('nama', 'like', '%' . $this->search . '%')
                        // Pencarian berdasarkan tingkat kelas yang terkait dengan pelajaran
                        ->orWhereHas('tingkatKelas', function ($q3) {
                            $q3->where('tingkat', 'like', '%' . $this->search . '%');
                        })
                        // Pencarian berdasarkan jurusan yang terkait dengan pelajaran
                        ->orWhereHas('jurusan', function ($q4) {
                            $q4->where('nama', 'like', '%' . $this->search . '%');
                        });
                });
        })
        ->orderBy('nama') // Urutkan modul berdasarkan nama
        ->paginate($this->paginate); // Tentukan jumlah data per halaman

    return view('livewire.superadmin.admin.modul.index', [
        'moduls' => $moduls,
        'tahunAjarans' => $this->tahunAjarans,
        'tahunAjaranAktif' => $this->tahunAjaranAktif,
        'title' => $this->title
    ]);
}

    public function resetForm()
    {
        $this->reset(['modul_id', 'nama', 'pelajaran_id', 'link', 'file']);
        $this->status = 1;
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
            'status' => 'required|in:0,1',
        ]);

        $filePath = $this->file ? $this->file->store('moduls', 'public') : null;

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
        $modul = Modul::findOrFail($id);
        $this->modul_id = $modul->id;
        $this->nama = $modul->nama;
        $this->pelajaran_id = $modul->pelajaran_id;
        $this->link = $modul->link;
        $this->status = $modul->status;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'pelajaran_id' => 'required',
            'link' => 'nullable|url',
            'file' => 'nullable|file',
            'status' => 'required|in:0,1',
        ]);

        $modul = Modul::findOrFail($this->modul_id);

        $filePath = $this->file ? $this->file->store('moduls', 'public') : $modul->file;

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
        Modul::findOrFail($this->modul_id)->delete();
        session()->flash('message', 'Modul berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }
}
