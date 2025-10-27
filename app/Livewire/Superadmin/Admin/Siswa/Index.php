<?php

namespace App\Livewire\Superadmin\Admin\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

#[Title('Data Siswa')]
class Index extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10, $search = '';
    public $nis, $name, $email, $no_hp, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat;
    public $kk, $akta, $ijazah_terakhir, $img, $status, $siswa_id;
    public $siswa_id_delete, $siswa_name_delete;

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'nis',
            'name',
            'email',
            'no_hp',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'kk',
            'akta',
            'ijazah_terakhir',
            'img',
            'status',
        ]);
    }

    public function store()
    {
        $this->validate([
            'nis' => 'required|unique:siswas,nis',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kk' => 'nullable|file|max:2048',
            'akta' => 'nullable|file|max:2048',
            'ijazah_terakhir' => 'nullable|file|max:2048',
            'img' => 'nullable|image|max:2048',
            'status' => 'required|string',
        ]);

        $data = [
            'nis' => $this->nis,
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'status' => $this->status,
        ];

        // Upload files
        if ($this->kk) $data['kk'] = $this->kk->store('kk', 'public');
        if ($this->akta) $data['akta'] = $this->akta->store('akta', 'public');
        if ($this->ijazah_terakhir) $data['ijazah_terakhir'] = $this->ijazah_terakhir->store('ijazah', 'public');
        if ($this->img) $data['img'] = $this->img->store('siswa_img', 'public');

        Siswa::create($data);

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->resetValidation();
        $siswa = Siswa::findOrFail($id);

        $this->nis = $siswa->nis;
        $this->name = $siswa->name;
        $this->email = $siswa->email;
        $this->no_hp = $siswa->no_hp;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->tempat_lahir = $siswa->tempat_lahir;
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->alamat = $siswa->alamat;
        $this->kk = $siswa->kk;
        $this->akta = $siswa->akta;
        $this->ijazah_terakhir = $siswa->ijazah_terakhir;
        $this->img = $siswa->img;
        $this->status = $siswa->status;
        $this->siswa_id = $siswa->id;
    }

    public function update()
    {
        $siswa = Siswa::findOrFail($this->siswa_id);

        $this->validate([
            'nis' => 'required|unique:siswas,nis,' . $this->siswa_id,
            'email' => 'required|email|unique:siswas,email,' . $this->siswa_id,
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kk' => 'nullable|file|max:2048',
            'akta' => 'nullable|file|max:2048',
            'ijazah_terakhir' => 'nullable|file|max:2048',
            'img' => 'nullable|image|max:2048',
            'status' => 'required|string',
        ]);

        $siswa->update([
            'nis' => $this->nis,
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'status' => $this->status,
        ]);

        // Update file jika diupload baru
        if ($this->kk) $siswa->kk = $this->kk->store('kk', 'public');
        if ($this->akta) $siswa->akta = $this->akta->store('akta', 'public');
        if ($this->ijazah_terakhir) $siswa->ijazah_terakhir = $this->ijazah_terakhir->store('ijazah', 'public');
        if ($this->img) $siswa->img = $this->img->store('siswa_img', 'public');
        $siswa->save();

        $this->dispatch('closeEditModal');
    }

    public function render()
    {
        $data = Siswa::with(['jurusan', 'kelas'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('nis', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->paginate);

        return view('livewire.superadmin.admin.siswa.index', [
            'title' => 'Data Siswa',
            'siswa' => $data,
        ]);
    }

    public function confirmDelete($id)
    {
        $siswa = Siswa::findOrFail($id);
        $this->siswa_id_delete = $siswa->id;
        $this->siswa_name_delete = $siswa->name;
    }

    public function destroy()
    {
        $siswa = Siswa::findOrFail($this->siswa_id_delete);

        // Optional: hapus file terkait jika diperlukan
        if ($siswa->kk) Storage::disk('public')->delete($siswa->kk);
        if ($siswa->akta) Storage::disk('public')->delete($siswa->akta);
        if ($siswa->ijazah_terakhir) Storage::disk('public')->delete($siswa->ijazah_terakhir);
        if ($siswa->img) Storage::disk('public')->delete($siswa->img);

        $siswa->delete();

        session()->flash('message', 'Siswa berhasil dihapus.');
        $this->dispatch('closeDeleteModal');
        $this->reset(['siswa_id_delete', 'siswa_name_delete']);
    }
}
