<?php

namespace App\Livewire\Superadmin\Admin\Bendahara;

use App\Models\Bendahara;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
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
            'email' => 'required|email|unique:bendaharas,email,' . $this->bendahara_id,
            'no_hp' => 'required|string',
            'img' => $this->bendahara_id ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
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
        $validatedData = $this->validate();

        if ($this->img) {
            $validatedData['img'] = $this->img->store('bendahara', 'public');
        }

        Bendahara::create($validatedData);
        if (!User::where('email', $validatedData['email'])->exists()) {
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'img' => $validatedData['img'],
                'password' => Hash::make($validatedData['kd_bendahara']),
                'role' => 'bendahara',
            ]);
        }

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'Bendahara berhasil ditambahkan.');
        $this->resetInputFields();
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

        $user = User::where('email', $bendahara->email)->first();
        if ($user) {
            $user->status = $validatedData['status'];
            $user->save();
        }

        $this->dispatch('closeEditModal');
        session()->flash('message', 'Data bendahara berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }
    public function destroy()
    {
        $bendahara = Bendahara::findOrFail($this->deleteId);

        // Hapus foto jika ada
        if ($bendahara->img && Storage::disk('public')->exists($bendahara->img)) {
            Storage::disk('public')->delete($bendahara->img);
        }

        // Hapus akun user terkait jika ada
        $user = User::where('email', $bendahara->email)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data guru
        $bendahara->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Bendahara dan akun user berhasil dihapus.');
        $this->deleteId = null;
    }
}
