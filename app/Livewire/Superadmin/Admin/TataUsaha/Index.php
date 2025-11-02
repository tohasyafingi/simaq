<?php

namespace App\Livewire\Superadmin\Admin\TataUsaha;

use App\Models\TataUsaha;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
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
            'email' => [
                'required',
                'email',
                Rule::unique('tata_usahas', 'email')->ignore($this->tata_usaha_id),
                Rule::unique('users', 'email')->ignore($this->tata_usaha_id ? User::where('tata_usaha_id', $this->tata_usaha_id)->value('id') : null),
            ],
            'no_hp' => 'required|string',
            'img' => 'nullable|image|max:2048',
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
            'title' => 'Data Tata Usaha',
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
        try {
            $validatedData = $this->validate();

            if ($this->img) {
                $validatedData['img'] = $this->img->store('karyawan', 'public');
            }

            $tata_usaha = TataUsaha::create($validatedData);

            // Cek jika email sudah ada di users
            if (User::where('email', $validatedData['email'])->exists()) {
                session()->flash('error', 'Email sudah digunakan oleh akun lain.');
                $tata_usaha->delete();
                return;
            }

            // Buat akun user dengan tata_usaha_id
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'img' => $validatedData['img'] ?? null,
                'password' => Hash::make($validatedData['kd_tu']),
                'role' => 'karyawan',  // Tetap 'karyawan' seperti kode asli
                'tata_usaha_id' => $tata_usaha->id,  // Tambahkan tata_usaha_id
                'status' => $validatedData['status'],
            ]);

            $this->dispatch('closeCreateModal');
            session()->flash('message', 'Tata Usaha berhasil ditambahkan dan akun karyawan dibuat.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan tata usaha.');
        }
    }

    public function edit($id)
    {
        $tata_usaha = TataUsaha::findOrFail($id);

        $this->tata_usaha_id = $tata_usaha->id;
        $this->kd_tu = $tata_usaha->kd_tu;
        $this->name = $tata_usaha->name;
        $this->email = $tata_usaha->email;
        $this->no_hp = $tata_usaha->no_hp;
        $this->img = $tata_usaha->img;
        $this->status = $tata_usaha->status;
    }

    public function update()
    {
        try {
            $validatedData = $this->validate();

            $tata_usaha = TataUsaha::findOrFail($this->tata_usaha_id);

            if ($this->img) {
                if ($tata_usaha->img && Storage::disk('public')->exists($tata_usaha->img)) {
                    Storage::disk('public')->delete($tata_usaha->img);
                }
                $validatedData['img'] = $this->img->store('karyawan', 'public');
            } else {
                $validatedData['img'] = $tata_usaha->img;
            }

            $tata_usaha->update($validatedData);

            // Update user jika ada
            $user = User::where('tata_usaha_id', $tata_usaha->id)->first();
            if ($user) {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'img' => $validatedData['img'],
                    'status' => $validatedData['status'],
                ]);
            }

            $this->dispatch('closeEditModal');
            session()->flash('message', 'Data tata usaha berhasil diperbarui.');
            $this->resetInputFields();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui tata usaha.');
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        try {
            $tata_usaha = TataUsaha::findOrFail($this->deleteId);

            // Hapus foto jika ada
            if ($tata_usaha->img && Storage::disk('public')->exists($tata_usaha->img)) {
                Storage::disk('public')->delete($tata_usaha->img);
            }

            // Hapus user terkait
            $user = User::where('tata_usaha_id', $tata_usaha->id)->first();
            if ($user) {
                $user->delete();
            }

            $tata_usaha->delete();

            $this->dispatch('closeDeleteModal');
            session()->flash('message', 'Tata Usaha dan akun user berhasil dihapus.');
            $this->deleteId = null;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus tata usaha.');
        }
    }
}
