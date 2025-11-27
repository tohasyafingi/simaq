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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BendaharaExport;
use App\Imports\BendaharaImport;
use Illuminate\Support\Facades\Log;

#[Title('Data Bendahara')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $file;
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

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $import = new BendaharaImport();
            Excel::import($import, $this->file);

            $errorCount = count($import->errors());
            $failureCount = count($import->failures());
            $skippedCount = property_exists($import, 'skipped') ? count($import->skipped) : 0;

            // Log detail failures untuk debugging
            if ($failureCount > 0) {
                foreach ($import->failures() as $failure) {
                    Log::warning("Baris {$failure->row()}: " . implode(', ', $failure->errors()));
                }
            }

            Log::info("Import selesai: {$errorCount} error, {$failureCount} gagal, {$skippedCount} di-skip.");

            $this->file = null;

            if ($errorCount > 0 || $failureCount > 0 || $skippedCount > 0) {
                $message = "Import selesai dengan beberapa masalah: ";
                if ($errorCount > 0) $message .= "{$errorCount} error. ";
                if ($failureCount > 0) $message .= "{$failureCount} gagal validasi (lihat log untuk detail). ";
                if ($skippedCount > 0) $message .= "{$skippedCount} baris di-skip. ";
                session()->flash('warning', $message);
            } else {
                session()->flash('message', 'Semua data Bendahara berhasil diimport.');
            }

            $this->dispatch('closeImportModal');
        } catch (\Exception $e) {
            Log::error("Exception di import: " . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
    public function downloadTemplate()
    {
        return Excel::download(new BendaharaExport('template'), 'template_bendahara.xlsx');
    }

    public function export()
    {
        return Excel::download(new BendaharaExport('data'), 'data_bendahara.xlsx');
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
                'bendahara_id' => $bendahara->id,
                'status' => $validatedData['status'] ? true : false,
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
                    'status' => $validatedData['status'] ? true : false,
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
