<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Downloads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Downloads')]
#[Layout('components.layouts.portal')]
class Download extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 6;

    // Reset halaman saat search berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $downloads = Downloads::where('status', 1)
            ->when($this->search, fn($q) =>
                $q->where('judul', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
            )
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.portal.download', [
            'downloads' => $downloads,
        ]);
    }
}
