<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Downloads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

        $meta = [
            'title' => 'Download',
            'description' => Str::limit(strip_tags(config('app.description', 'Download file dan dokumen Madrasah Aliyah (MA) Takhassus Al-Qur`an Wonosobo')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.download', [
            'downloads' => $downloads,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
