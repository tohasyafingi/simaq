<?php

namespace App\Livewire\Superadmin\Admin\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    // Form fields
    public $guru_id, $kd_guru, $name, $email, $no_hp, $img, $status;

    public $deleteId = null;

    protected function rules()
    {
        return [
            'kd_guru' => 'required|string|unique:gurus,kd_guru,' . $this->guru_id,
            'name' => 'required|string',
            'email' => 'required|email|unique:gurus,email,' . $this->guru_id,
            'no_hp' => 'required|string',
            'img' => $this->guru_id ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ];
    }

    public function render()
    {
        $gurus = Guru::where('kd_guru', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.guru.index', [
            'title' => 'Data Guru',
            'gurus' => $gurus,
        ])->title('Data Guru');
    }

    public function resetInputFields()
    {
        $this->guru_id = null;
        $this->kd_guru = '';
        $this->name = '';
        $this->email = '';
        $this->no_hp = '';
        $this->img = null;
        $this->status = '';
    }

    public function create()
    {
        $this->resetInputFields();
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->img) {
            $validatedData['img'] = $this->img->store('guru', 'public');
        }

        $guru = Guru::create($validatedData);

        // Membuat akun user otomatis
        if (!User::where('email', $validatedData['email'])->exists()) {
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['kd_guru']),
                'role' => 'guru',
            ]);
        
        }

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Guru berhasil ditambahkan dan akun guru dibuat.');
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        $this->guru_id = $guru->id;
        $this->kd_guru = $guru->kd_guru;
        $this->name = $guru->name;
        $this->email = $guru->email;
        $this->no_hp = $guru->no_hp;
        $this->status = $guru->status;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $guru = Guru::findOrFail($this->guru_id);

        if ($this->img) {
            if ($guru->img && Storage::disk('public')->exists($guru->img)) {
                Storage::disk('public')->delete($guru->img);
            }
            $validatedData['img'] = $this->img->store('guru', 'public');
        } else {
            $validatedData['img'] = $guru->img;
        }

        $guru->update($validatedData);

        $user = User::where('email', $guru->email)->first();
        if ($user) {
            $user->status = $validatedData['status'];
            $user->save();
        }

        $this->dispatch('closeEditModal');
        session()->flash('message', 'Data guru berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $guru = Guru::findOrFail($this->deleteId);

        // Hapus foto jika ada
        if ($guru->img && Storage::disk('public')->exists($guru->img)) {
            Storage::disk('public')->delete($guru->img);
        }

        // Hapus akun user terkait jika ada
        $user = User::where('email', $guru->email)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data guru
        $guru->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Guru dan akun user berhasil dihapus.');
        $this->deleteId = null;
    }
}
