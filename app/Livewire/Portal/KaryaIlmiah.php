<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KaryaIlmiah as karya;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Karya Ilmiah')]
#[Layout('components.layouts.portal')]
class KaryaIlmiah extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $karya_ilmiahs = Karya::where('status', 1)
            ->where(function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('livewire.portal.karya-ilmiah', compact('karya_ilmiahs'));
    }
}
