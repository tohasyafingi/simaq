<?php

namespace App\Livewire\Superadmin\Admin\Guru;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Data Guru')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public $guru_id, $kd_guru, $name, $email, $no_hp, $img, $status;

    public $deleteId = null;

    protected function rules()
    {
        return [
            'kd_guru' => 'required|string|unique:gurus,kd_guru,' . $this->guru_id,
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('gurus', 'email')->ignore($this->guru_id),
                Rule::unique('users', 'email')->ignore($this->guru_id ? User::where('guru_id', $this->guru_id)->value('id') : null),
            ],
            'no_hp' => 'required|string',
            'img' => 'nullable|image|max:2048',  
            'status' => 'required|boolean',
        ];
    }

    public function render()
    {
        $gurus = Guru::where(function ($q) {  
            $q->where('kd_guru', 'like', '%' . $this->search . '%')
              ->orWhere('name', 'like', '%' . $this->search . '%')
              ->orWhere('email', 'like', '%' . $this->search . '%')
              ->orWhere('no_hp', 'like', '%' . $this->search . '%');
        })->orderBy('name')->paginate($this->paginate);

        return view('livewire.superadmin.admin.guru.index', [
            'title' => 'Data Guru',
            'gurus' => $gurus,
        ]);
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
        try {
            $validatedData = $this->validate();

            if ($this->img) {  
                $validatedData['img'] = $this->img->store('guru', 'public');
            }

            $guru = Guru::create($validatedData);

            if (User::where('email', $validatedData['email'])->exists()) {
                session()->flash('error', 'Email sudah digunakan oleh akun lain.');
                $guru->delete();
                return;
            }

            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'img' => $validatedData['img'] ?? null,  
                'password' => Hash::make($validatedData['kd_guru']),
                'role' => 'guru',
                'guru_id' => $guru->id,
                'status' => $validatedData['status'],  
            ]);

            $this->dispatch('closeCreateModal');
            session()->flash('message', 'Guru berhasil ditambahkan dan akun guru dibuat.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan guru.');
        }
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        $this->guru_id = $guru->id;
        $this->kd_guru = $guru->kd_guru;
        $this->name = $guru->name;
        $this->email = $guru->email;
        $this->no_hp = $guru->no_hp;
        $this->img = null;  
        $this->status = $guru->status;
    }

    public function update()
    {
        try {
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

            $user = User::where('guru_id', $guru->id)->first();
            if ($user) {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'img' => $validatedData['img'],
                    'status' => $validatedData['status'],
                ]);
            }

            $this->dispatch('closeEditModal');
            session()->flash('message', 'Data guru berhasil diperbarui.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui guru.');
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        try {
            $guru = Guru::findOrFail($this->deleteId);

            if ($guru->img && Storage::disk('public')->exists($guru->img)) {
                Storage::disk('public')->delete($guru->img);
            }

            $user = User::where('guru_id', $guru->id)->first();
            if ($user) {
                $user->delete();
            }

            $guru->delete();

            $this->dispatch('closeDeleteModal');
            session()->flash('message', 'Guru dan akun user berhasil dihapus.');
            $this->deleteId = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus guru.');
        }
    }
}
