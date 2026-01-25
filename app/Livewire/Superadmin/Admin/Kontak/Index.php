<?php

namespace App\Livewire\Superadmin\Admin\Kontak;

use App\Models\Kontak;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Cache;

#[Title('Data Kontak')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $paginate = 10;

    public $alamat;
    public $telepon;
    public $email;
    public $google_map_embed;
    public $facebook;
    public $twitter;
    public $instagram;
    public $tiktok;
    public $youtube;
    public $about;
    public $copyright;

    public $kontakId;
    public $isEdit = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $kontaks = Kontak::when($this->search, fn($q) =>
                        $q->where('alamat', 'like', "%{$this->search}%")
                          ->orWhere('telepon', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%")
                    )
                    ->orderBy('id', 'desc')
                    ->paginate($this->paginate);

        return view('livewire.superadmin.admin.kontak.index', [
            'kontaks' => $kontaks,
            'title' => 'Data Kontak',
        ]);
    }

    public function resetForm()
    {
        $this->alamat = '';
        $this->telepon = '';
        $this->email = '';
        $this->google_map_embed = '';
        $this->facebook = '';
        $this->twitter = '';
        $this->instagram = '';
        $this->youtube = '';
        $this->about = '';
        $this->copyright = '';
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'google_map_embed' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
        ]);

        Kontak::create([
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'google_map_embed' => $this->google_map_embed,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'about' => $this->about,
            'copyright' => $this->copyright,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan!');
        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);
        $this->kontakId = $kontak->id;
        $this->alamat = $kontak->alamat;
        $this->telepon = $kontak->telepon;
        $this->email = $kontak->email;
        $this->google_map_embed = $kontak->google_map_embed;
        $this->facebook = $kontak->facebook;
        $this->twitter = $kontak->twitter;
        $this->tiktok = $kontak->tiktok;
        $this->instagram = $kontak->instagram;
        $this->youtube = $kontak->youtube;
        $this->about = $kontak->about;
        $this->copyright = $kontak->copyright;
        $this->isEdit = true;
    }

public function update()
{
    $this->validate([
        'alamat' => 'nullable|string',
        'telepon' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
        'google_map_embed' => 'nullable|string',
        'facebook' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'tiktok' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'youtube' => 'nullable|string|max:255',
        'about' => 'nullable|string',
        'copyright' => 'nullable|string|max:255',
    ]);

    $kontak = Kontak::findOrFail($this->kontakId);

    $kontak->update([
        'alamat' => $this->alamat,
        'telepon' => $this->telepon,
        'email' => $this->email,
        'google_map_embed' => $this->google_map_embed,
        'facebook' => $this->facebook,
        'twitter' => $this->twitter,
        'tiktok' => $this->tiktok,
        'instagram' => $this->instagram,
        'youtube' => $this->youtube,
        'about' => $this->about,
        'copyright' => $this->copyright,
    ]);

    Cache::forget('footer_kontak');

    session()->flash('message', 'Data berhasil diperbarui!');
    $this->dispatch('closeEditModal');
}


    public function confirmDelete($id)
    {
        $this->kontakId = $id;
    }

    public function destroy()
    {
        Kontak::findOrFail($this->kontakId)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        $this->dispatch('closeDeleteModal');
    }
}
