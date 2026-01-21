<?php

namespace App\Livewire\Superadmin\Admin\WebData;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\Profiles;
use Illuminate\Support\Facades\Storage;

#[Title('Konten Portal')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Konten Portal';
    public $paginate = 10;
    public $search = '';
    public $selectedType = '';

    // Form fields
    public $profile_id;
    public $type;
    public $judul;
    public $content;
    public $link;
    public $status = 1;
    public $image;
    public $newImage;

    public $deleteId = null;

    /* ================= VALIDATION ================= */

    protected function rules()
    {
        return [
            'type'     => 'required|string|max:50',
            'judul'    => 'required|string|max:255',
            'content'  => 'required|string',
            'link'     => 'nullable|string|max:255',
            'status'   => 'required|boolean',
            'newImage' => 'nullable|image|max:2048',
        ];
    }

    /* ================= RENDER ================= */

    public function render()
    {
        $profiles = Profiles::where(function ($q) {
            if ($this->search) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            }
        })
            ->when(
                $this->selectedType,
                fn($q) =>
                $q->where('type', $this->selectedType)
            )
            ->latest()
            ->paginate($this->paginate);

        $types = Profiles::select('type')->distinct()->pluck('type');

        return view('livewire.superadmin.admin.web-data.index', [
            'title'    => $this->title,
            'profiles' => $profiles,
            'types'    => $types,
        ]);
    }

    /* ================= HELPER ================= */

    public function resetInputFields()
    {
        $this->profile_id = null;
        $this->type = '';
        $this->judul = '';
        $this->content = '';
        $this->link = '';
        $this->status = 1;
        $this->image = null;
        $this->newImage = null;
    }

    /* ================= CRUD ================= */

    public function create()
    {
        $this->resetValidation();
        $this->resetInputFields();

        $this->dispatch('openCreateModal');
    }



    public function store()
    {
        $validated = $this->validate();

        if ($this->newImage) {
            $validated['image'] = $this->newImage->store('profiles', 'public');
        }

        Profiles::create($validated);

        $this->dispatch('closeCreateModal');
        $this->dispatch('resetSummernote');
        session()->flash('message', 'Konten berhasil ditambahkan.');
        $this->resetInputFields();
        $this->resetPage();
    }


    public function edit($id)
    {
        $data = Profiles::findOrFail($id);

        $this->profile_id = $data->id;
        $this->type = $data->type;
        $this->judul = $data->judul;
        $this->content = $data->content;
        $this->link = $data->link;
        $this->status = $data->status;
        $this->image = $data->image;

        $this->dispatch('openEditModal', content: $this->content);
    }

    public function removeImage()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            Storage::disk('public')->delete($this->image);
        }

        // update database
        Profiles::where('id', $this->profile_id)->update([
            'image' => null,
        ]);

        // reset state
        $this->image = null;
        $this->newImage = null;

        session()->flash('message', 'Gambar berhasil dihapus.');
    }

    public function update()
    {
        $validated = $this->validate();

        $data = Profiles::findOrFail($this->profile_id);

        if ($this->newImage) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $validated['image'] = $this->newImage->store('profiles', 'public');
        } else {
            $validated['image'] = $data->image; // tetap pakai image lama
        }

        $data->update($validated);

        $this->dispatch('closeEditModal');
        $this->dispatch('resetSummernote');
        session()->flash('message', 'Konten berhasil diperbarui.');

        $this->resetInputFields();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function destroy()
    {
        $data = Profiles::findOrFail($this->deleteId);

        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        $this->dispatch('closeDeleteModal');
        session()->flash('message', 'Konten berhasil dihapus.');
        $this->resetPage();
        $this->deleteId = null;
    }
}
