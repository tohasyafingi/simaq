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
    public $existingFile;
    public $paginate = 10;
    public $search = '';
    public $modul_id, $nama, $pelajaran_id, $link, $file, $status = 1;
    public $pelajarans, $pelajaran_nama, $tingkat_nama, $jurusan_nama;
    public $tahunAjarans, $tahunAjaranAktif;
    public $tahun_ajaran_id;

    // Initializing values on component mount
    public function mount()
    {
        $this->pelajarans = Pelajaran::where('status', 1)->get();
        $this->tahunAjarans = TahunAjaran::orderBy('tahun', 'desc')->get();
        $this->tahunAjaranAktif = TahunAjaran::where('status', true)->first();
        if ($this->tahunAjaranAktif) {
            $this->tahun_ajaran_id = $this->tahunAjaranAktif->id;
        }
        if ($this->modul_id) {
            $modul = Modul::find($this->modul_id);
            $this->existingFile = $modul->file;
        }
    }

    // Reset pagination when search query changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Main render method for Livewire
    public function render()
    {
        $moduls = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])
            ->when($this->search, fn($query) => $this->applySearchFilters($query))
            ->orderBy('nama')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.modul.index', [
            'moduls' => $moduls,
            'tahunAjarans' => $this->tahunAjarans,
            'tahunAjaranAktif' => $this->tahunAjaranAktif,
            'title' => $this->title
        ]);
    }

    // Extracted search logic to improve readability
    protected function applySearchFilters($query)
    {
        return $query->where('nama', 'like', '%' . $this->search . '%')
            ->orWhereHas('pelajaran', function ($q2) {
                $q2->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhereHas('tingkatKelas', fn($q3) => $q3->where('tingkat', 'like', '%' . $this->search . '%'))
                    ->orWhereHas('jurusan', fn($q4) => $q4->where('nama', 'like', '%' . $this->search . '%'));
            });
    }

    // Reset form fields
    public function resetForm()
    {
        $this->reset(['modul_id', 'nama', 'pelajaran_id', 'link', 'file']);
        $this->status = 1;
    }

    // Show create modal
    public function create()
    {
        $this->resetForm();
    }

    // Store new Modul
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'pelajaran_id' => 'required',
            'link' => 'nullable|url|max:255',
            'file' => 'nullable|file|max:10240',
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

    // Show edit modal with existing data
    public function edit($id)
    {
        $modul = Modul::findOrFail($id);
        $this->modul_id = $modul->id;
        $this->nama = $modul->nama;
        $this->pelajaran_id = $modul->pelajaran_id;
        $this->link = $modul->link;
        $this->status = $modul->status;
    }

    // Update Modul
    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'pelajaran_id' => 'required',
            'link' => 'nullable|url|max:255',
            'file' => 'nullable|file|max:10240',
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

    // Show delete confirmation modal
    public function confirmDelete($id)
    {
        $modul = Modul::with(['pelajaran.jurusan', 'pelajaran.tingkatKelas'])->findOrFail($id);
        $this->modul_id = $id;
        $this->nama = $modul->nama;
        $this->pelajaran_nama = $modul->pelajaran->nama ?? '-';
        $this->tingkat_nama = $modul->pelajaran->tingkatKelas->tingkat ?? '-';
        $this->jurusan_nama = $modul->pelajaran->jurusan->nama ?? '-';
    }

    // Destroy Modul
    public function destroy()
    {
        Modul::findOrFail($this->modul_id)->delete();
        session()->flash('message', 'Modul berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->resetForm();
    }
}
