<?php

namespace App\Livewire\Superadmin\Admin\TataUsaha;

use App\Models\TataUsaha;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

#[Title('Data Tata Usaha')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    // Form fields
    public $tata_usaha_id, $kd_tu, $name, $email, $no_hp, $img, $status;

    public $deleteId = null;

    protected function rules()
    {
        return [
            'kd_tu' => 'required|string|unique:tata_usahas,kd_tu,' . $this->tata_usaha_id,
            'name' => 'required|string',
            'email' => 'required|email|unique:tata_usahas,email,' . $this->tata_usaha_id,
            'no_hp' => 'required|string',
            'img' => $this->tata_usaha_id ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ];
    }

    public function render()
    {
        $tata_usahas = TataUsaha::where('kd_tu', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.tata-usaha.index', [
            'title' => 'Data TataUsaha',
            'tata_usahas' => $tata_usahas,
        ]);
    }

    public function resetInputFields()
    {
        $this->tata_usaha_id = null;
        $this->kd_tu = '';
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
            $validatedData['img'] = $this->img->store('karyawan', 'public');
        }

        TataUsaha::create($validatedData);
        if (!User::where('email', $validatedData['email'])->exists()) {
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['kd_tu']),
                'role' => 'karyawan',
            ]);
        }

        $this->dispatch('closeCreateModal');
        session()->flash('message', 'TataUsaha berhasil ditambahkan.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $karyawan = TataUsaha::findOrFail($id);

        $this->tata_usaha_id = $karyawan->id;
        $this->kd_tu = $karyawan->kd_tu;
        $this->name = $karyawan->name;
        $this->email = $karyawan->email;
        $this->no_hp = $karyawan->no_hp;
        $this->status = $karyawan->status;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $karyawan = TataUsaha::findOrFail($this->tata_usaha_id);

        if ($this->img) {
            if ($karyawan->img && Storage::disk('public')->exists($karyawan->img)) {
                Storage::disk('public')->delete($karyawan->img);
            }
            $validatedData['img'] = $this->img->store('karyawan', 'public');
        } else {
            $validatedData['img'] = $karyawan->img;
        }

        $karyawan->update($validatedData);

        $user = User::where('email', $karyawan->email)->first();
        if ($user) {
            $user->status = $validatedData['status'];
            $user->save();
        }

        $this->dispatch('closeEditModal');
        session()->flash('message', 'Data karyawan berhasil diperbarui.');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }
    public function destroy()
    {
        $karyawan = TataUsaha::findOrFail($this->deleteId);

        // Hapus foto jika ada
        if ($karyawan->img && Storage::disk('public')->exists($karyawan->img)) {
            Storage::disk('public')->delete($karyawan->img);
        }

        // Hapus akun user terkait jika ada
        $user = User::where('email', $karyawan->email)->first();
        if ($user) {
            $user->delete();
        }

        // Hapus data guru
        $karyawan->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'TataUsaha dan akun user berhasil dihapus.');
        $this->deleteId = null;
    }
}

