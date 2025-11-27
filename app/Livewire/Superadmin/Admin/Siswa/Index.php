<?php

namespace App\Livewire\Superadmin\Admin\Siswa;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
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
    public $file;

    protected function rules()
    {
        return [
            'nis' => 'required|unique:siswas,nis,' . $this->siswa_id,
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('siswas', 'email')->ignore($this->siswa_id),
                Rule::unique('users', 'email')->ignore($this->siswa_id ? User::where('siswa_id', $this->siswa_id)->value('id') : null),
            ],
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kk' => 'nullable|file|max:2048',
            'akta' => 'nullable|file|max:2048',
            'ijazah_terakhir' => 'nullable|file|max:2048',
            'img' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,tidak_aktif,lulus',
        ];
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'siswa_id',
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

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $import = new SiswaImport();
            Excel::import($import, $this->file);

            // ✅ Gunakan getter method
            $errors = $import->getErrors();
            $failures = $import->getFailures();
            $skipped = $import->skipped ?? [];

            $this->file = null;

            // Hitung hasil
            $errorCount = count($errors);
            $failureCount = count($failures);
            $skippedCount = count($skipped);

            $message = "Import selesai: {$errorCount} error, {$failureCount} gagal, {$skippedCount} di-skip.";

            // Log detail ke storage/logs/laravel.log
            if ($failureCount > 0) {
                foreach ($failures as $failure) {
                    Log::warning("Baris {$failure->row()}: " . implode(', ', $failure->errors()));
                }
            }

            Log::info($message);

            // Tampilkan feedback ke UI
            if ($errorCount > 0 || $failureCount > 0 || $skippedCount > 0) {
                session()->flash('warning', $message);
            } else {
                session()->flash('message', 'Semua data siswa berhasil diimport.');
            }

            $this->dispatch('closeImportModal');
        } catch (\Exception $e) {
            Log::error("Exception di import siswa: " . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new SiswaExport('template'), 'template_siswa.xlsx');
    }

    public function export()
    {
        return Excel::download(new SiswaExport('data'), 'data_siswa.xlsx');
    }


    public function store()
    {
        try {
            $validatedData = $this->validate();

            $data = [
                'nis' => $validatedData['nis'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'alamat' => $validatedData['alamat'],
                'status' => $validatedData['status'],
            ];

            // Upload files
            if ($this->kk) $data['kk'] = $this->kk->store('kk', 'public');
            if ($this->akta) $data['akta'] = $this->akta->store('akta', 'public');
            if ($this->ijazah_terakhir) $data['ijazah_terakhir'] = $this->ijazah_terakhir->store('ijazah', 'public');
            if ($this->img) $data['img'] = $this->img->store('siswa_img', 'public');

            // Membuat siswa
            $siswa = Siswa::create($data);

            // Cek jika email sudah ada di users
            if (User::where('email', $validatedData['email'])->exists()) {
                session()->flash('error', 'Email sudah digunakan oleh akun lain.');
                $siswa->delete();
                return;
            }

            // Membuat akun user dengan siswa_id
            try {
                User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'img' => $data['img'] ?? null,
                    'password' => Hash::make($validatedData['nis']),
                    'role' => 'siswa',
                    'siswa_id' => $siswa->id,
                    'status' => $validatedData['status'] === 'aktif',
                ]);
            } catch (\Exception $e) {
                // Jika User gagal dibuat, hapus Siswa untuk konsistensi
                $siswa->delete();
                session()->flash('error', 'Gagal membuat akun user: ' . $e->getMessage());
                return;
            }

            $this->dispatch('closeCreateModal');
            session()->flash('message', 'Siswa berhasil ditambahkan dan akun siswa dibuat.');
            $this->create();  // Reset form
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan siswa: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->resetValidation();
        $siswa = Siswa::findOrFail($id);

        $this->siswa_id = $siswa->id;
        $this->nis = $siswa->nis;
        $this->name = $siswa->name;
        $this->email = $siswa->email;
        $this->no_hp = $siswa->no_hp;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->tempat_lahir = $siswa->tempat_lahir;
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->alamat = $siswa->alamat;
        $this->kk = null;  // Reset untuk upload baru
        $this->akta = null;
        $this->ijazah_terakhir = null;
        $this->img = null;
        $this->status = $siswa->status;
    }

    public function update()
    {
        try {
            $validatedData = $this->validate();

            $siswa = Siswa::findOrFail($this->siswa_id);

            // Update data siswa
            $siswa->update($validatedData);

            // Handle file uploads (hapus lama jika ada, upload baru)
            if ($this->kk) {
                if ($siswa->kk && Storage::disk('public')->exists($siswa->kk)) {
                    Storage::disk('public')->delete($siswa->kk);
                }
                $siswa->kk = $this->kk->store('kk', 'public');
            }
            if ($this->akta) {
                if ($siswa->akta && Storage::disk('public')->exists($siswa->akta)) {
                    Storage::disk('public')->delete($siswa->akta);
                }
                $siswa->akta = $this->akta->store('akta', 'public');
            }
            if ($this->ijazah_terakhir) {
                if ($siswa->ijazah_terakhir && Storage::disk('public')->exists($siswa->ijazah_terakhir)) {
                    Storage::disk('public')->delete($siswa->ijazah_terakhir);
                }
                $siswa->ijazah_terakhir = $this->ijazah_terakhir->store('ijazah', 'public');
            }
            if ($this->img) {
                if ($siswa->img && Storage::disk('public')->exists($siswa->img)) {
                    Storage::disk('public')->delete($siswa->img);
                }
                $siswa->img = $this->img->store('siswa_img', 'public');
            }
            $siswa->save();

            // Update user terkait (pastikan siswa_id tetap)
            $user = User::where('siswa_id', $siswa->id)->first();
            if ($user) {
                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'img' => $siswa->img,
                    'status' => $validatedData['status'] === 'aktif',
                ]);
            }

            $this->dispatch('closeEditModal');
            session()->flash('message', 'Data siswa berhasil diperbarui.');
            $this->create();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui siswa: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $data = Siswa::with(['jurusan'])
            ->where('status', '!=', 'lulus')
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
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
        try {
            $siswa = Siswa::findOrFail($this->siswa_id_delete);

            // Hapus file
            if ($siswa->kk && Storage::disk('public')->exists($siswa->kk)) Storage::disk('public')->delete($siswa->kk);
            if ($siswa->akta && Storage::disk('public')->exists($siswa->akta)) Storage::disk('public')->delete($siswa->akta);
            if ($siswa->ijazah_terakhir && Storage::disk('public')->exists($siswa->ijazah_terakhir)) Storage::disk('public')->delete($siswa->ijazah_terakhir);
            if ($siswa->img && Storage::disk('public')->exists($siswa->img)) Storage::disk('public')->delete($siswa->img);

            // Hapus user terkait dulu
            $user = User::where('siswa_id', $siswa->id)->first();
            if ($user) {
                $user->delete();
            }

            $siswa->delete();

            session()->flash('message', 'Siswa dan akun user berhasil dihapus.');
            $this->dispatch('closeDeleteModal');
            $this->reset(['siswa_id_delete', 'siswa_name_delete']);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus siswa: ' . $e->getMessage());
        }
    }
}
