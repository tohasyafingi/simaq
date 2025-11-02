<?php

namespace App\Livewire\Superadmin\Admin\Bendahara;

use App\Models\Bendahara;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Data Bendahara')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public $bendahara_id, $kd_bendahara, $name, $email, $no_hp, $img, $status;

    public $deleteId = null;

    protected function rules()
    {
        return [
            'kd_bendahara' => 'required|string|unique:bendaharas,kd_bendahara,' . $this->bendahara_id,
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('bendaharas', 'email')->ignore($this->bendahara_id),
                Rule::unique('users', 'email')->ignore($this->bendahara_id ? User::where('bendahara_id', $this->bendahara_id)->value('id') : null),
            ],
            'no_hp' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ];
    }

    public function render()
    {
        $bendaharas = Bendahara::where('kd_bendahara', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.bendahara.index', [
            'title' => 'Data Bendahara',
            'bendaharas' => $bendaharas,
        ]);
    }

    public function resetInputFields()
    {
        $this->bendahara_id = null;
        $this->kd_bendahara = '';
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
                $validatedData['img'] = $this->img->store('bendahara', 'public');
            }

            $bendahara = Bendahara::create($validatedData);

            // Cek jika email sudah ada di users
            if (User::where('email', $validatedData['email'])->exists()) {
                session()->flash('error', 'Email sudah digunakan oleh akun lain.');
                $bendahara->delete();
                return;
            }

            // Buat akun user dengan bendahara_id
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'img' => $validatedData['img'] ?? null,
                'password' => Hash::make($validatedData['kd_bendahara']),
                'role' => 'bendahara',
                'bendahara_id' => $bendahara->id,  // Tambahkan bendahara_id
                'status' => $validatedData['status'],
            ]);

            $this->dispatch('closeCreateModal');
            session()->flash('message', 'Bendahara berhasil ditambahkan dan akun bendahara dibuat.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan bendahara.');
        }
    }

    public function edit($id)
    {
        $bendahara = Bendahara::findOrFail($id);

        $this->bendahara_id = $bendahara->id;
        $this->kd_bendahara = $bendahara->kd_bendahara;
        $this->name = $bendahara->name;
        $this->email = $bendahara->email;
        $this->no_hp = $bendahara->no_hp;
        $this->img = $bendahara->img;
        $this->status = $bendahara->status;
    }

    public function update()
    {
        try {
            $validatedData = $this->validate();

            $bendahara = Bendahara::findOrFail($this->bendahara_id);

            if ($this->img) {
                if ($bendahara->img && Storage::disk('public')->exists($bendahara->img)) {
                    Storage::disk('public')->delete($bendahara->img);
                }
                $validatedData['img'] = $this->img->store('bendahara', 'public');
            } else {
                $validatedData['img'] = $bendahara->img;
            }

            $bendahara->update($validatedData);

            // Update user jika ada
            $user = User::where('bendahara_id', $bendahara->id)->first();
            if ($user) {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'img' => $validatedData['img'],
                    'status' => $validatedData['status'],
                ]);
            }

            $this->dispatch('closeEditModal');
            session()->flash('message', 'Data bendahara berhasil diperbarui.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui bendahara.');
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        try {
            $bendahara = Bendahara::findOrFail($this->deleteId);

            // Hapus foto jika ada
            if ($bendahara->img && Storage::disk('public')->exists($bendahara->img)) {
                Storage::disk('public')->delete($bendahara->img);
            }

            // Hapus user terkait
            $user = User::where('bendahara_id', $bendahara->id)->first();
            if ($user) {
                $user->delete();
            }

            $bendahara->delete();

            $this->dispatch('closeDeleteModal');
            session()->flash('message', 'Bendahara dan akun user berhasil dihapus.');
            $this->deleteId = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus bendahara.');
        }
    }
}
