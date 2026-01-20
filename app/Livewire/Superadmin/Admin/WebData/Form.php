<?php

namespace App\Livewire\Superadmin\Admin\WebData;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profiles;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

#[Title('Data Website Profiles')]
class Form extends Component
{
    use WithFileUploads;

    public $modelId;
    public $type;
    public $judul;
    public $image;
    public $newImage;
    public $content;
    public $link;
    public $status = 1; // boolean in DB

    protected $listeners = [
        'create' => 'create',
        'edit' => 'edit',
    ];

    protected function rules()
    {
        return [
            'type' => ['required', 'in:tentang,sejarah,visi,misi,jurusan,ekstrakurikuler,osis,pramuka,tahfidz,ppdb'],
            'judul' => 'nullable|string|max:255',
            'newImage' => 'nullable|image|max:2048',
            'content' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'status' => 'boolean',
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->dispatch('show-form-modal');
    }

    public function edit($id)
    {
        $this->resetValidation();
        $this->resetForm();
        $model = Profiles::findOrFail($id);
        $this->modelId = $model->id;
        $this->type = $model->type;
        $this->judul = $model->judul;
        $this->image = $model->image;
        $this->content = $model->content;
        $this->link = $model->link;
        $this->status = (int) $model->status;
        $this->dispatch('show-form-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->modelId) {
            $model = Profiles::findOrFail($this->modelId);
        } else {
            $model = new Profiles();
        }

        $model->type = $this->type;
        $model->judul = $this->judul;
        $model->content = $this->content;
        $model->link = $this->link;
        $model->status = (bool) $this->status;

        if ($this->newImage) {
            if ($model->image) {
                Storage::disk('public')->delete($model->image);
            }
            $path = $this->newImage->store('profiles', 'public');
            $model->image = $path;
        }

        $model->save();

        $this->dispatch('hide-form-modal');
        session()->flash('success', 'Data tersimpan.');
        $this->dispatch('profileSaved');
    }

    private function resetForm()
    {
        $this->modelId = null;
        $this->type = null;
        $this->judul = null;
        $this->image = null;
        $this->newImage = null;
        $this->content = null;
        $this->link = null;
        $this->status = 1;
    }

    public function render()
    {
        return view('livewire.superadmin.admin.web-data.form');
    }
}
