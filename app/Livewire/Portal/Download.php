<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Downloads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

#[Title('Downloads')]
#[Layout('components.layouts.portal')]
class Download extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 6;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function downloadFile($id)
    {
        $item = Downloads::where('status', 1)->findOrFail($id);

        if (!$item->file || !Storage::disk('public')->exists($item->file)) {
            abort(404);
        }

        $extension = pathinfo($item->file, PATHINFO_EXTENSION);

        $fileName = Str::slug($item->judul) . '.' . $extension;

        return response()->download(
            storage_path('app/public/' . $item->file),
            $fileName
        );
    }

    public function render()
    {
        $downloads = Downloads::where('status', 1)
            ->when(
                $this->search,
                fn($q) =>
                $q->where(function ($sub) {
                    $sub->where('judul', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                })
            )
            ->latest()
            ->paginate($this->perPage);

        $meta = [
            'title' => 'Download',
            'description' => Str::limit(
                strip_tags(config('app.description', 'Download file dan dokumen MA Takhassus Al-Qur’an Wonosobo')),
                160
            ),
            'image' => \App\Helpers\SeoHelper::image(null),
            'canonical' => url()->current(),
            'og_type' => 'website',
        ];

        return view('livewire.portal.download', [
            'downloads' => $downloads,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
