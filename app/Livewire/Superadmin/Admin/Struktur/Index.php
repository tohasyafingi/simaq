<?php

namespace App\Livewire\Superadmin\Admin\Struktur;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Struktur;
use App\Models\User;
use Livewire\Attributes\Title;

#[Title('Data Struktur Organisasi')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Data Struktur Organisasi';

    public $search = '';
    public $paginate = 10;
    public $nama;
    public $jabatan;
    public $urutan;
    public $user_id;
    public $status = 1;
    public $strukturId;
    public $isEdit = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $strukturs = Struktur::with('user')
            ->when($this->search, fn($q) => $q->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('jabatan', 'like', '%' . $this->search . '%')
                ->orWhere('urutan', 'like', '%' . $this->search . '%'))
            ->orderBy('urutan', 'asc')
            ->paginate($this->paginate);

        $users = User::whereIn('role', ['admin', 'guru', 'bendahara', 'karyawan'])->get();

        return view('livewire.superadmin.admin.struktur.index', [
            'strukturs' => $strukturs,
            'users' => $users,
        ]);
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->jabatan = '';
        $this->urutan = '';
        $this->user_id = '';
        $this->status = 1;
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);


        Struktur::create([
            'nama' => User::find($this->user_id)?->name ?? null,
            'jabatan' => $this->jabatan,
            'urutan' => $this->urutan,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);


        session()->flash('message', 'Data berhasil ditambahkan!');
        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $struktur = Struktur::findOrFail($id);
        $this->strukturId = $struktur->id;
        $this->nama = $struktur->nama;
        $this->jabatan = $struktur->jabatan;
        $this->urutan = $struktur->urutan;
        $this->user_id = $struktur->user_id;
        $this->status = $struktur->status;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'required|in:0,1',
        ]);


        $struktur = Struktur::findOrFail($this->strukturId);
        $struktur->update([
            'nama' => User::find($this->user_id)?->name ?? $struktur->nama,
            'jabatan' => $this->jabatan,
            'urutan' => $this->urutan,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);


        session()->flash('message', 'Data berhasil diperbarui!');
        $this->dispatch('closeEditModal');
    }

    public function confirmDelete($id)
    {
        $this->strukturId = $id;
    }

    public function destroy()
    {
        Struktur::findOrFail($this->strukturId)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        $this->dispatch('closeDeleteModal');
    }
}
