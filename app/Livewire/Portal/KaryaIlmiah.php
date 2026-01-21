<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KaryaIlmiah as karya;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

        $meta = [
            'title' => 'Karya Ilmiah',
            'description' => Str::limit(strip_tags(config('app.description', 'Kumpulan karya ilmiah')), 160),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website'
        ];

        return view('livewire.portal.karya-ilmiah', compact('karya_ilmiahs'))
            ->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
