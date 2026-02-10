<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Downloads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\SeoHelper;

#[Title('Downloads')]
#[Layout('components.layouts.portal')]
class Download extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 9;
    public $selectedDownload;
    public $slug = null;

    public function mount($slug = null)
    {
        $this->slug = $slug;
    }


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
                $this->slug,
                fn($q) =>
                $q->where('slug', $this->slug)
            )
            ->when(
                $this->search && !$this->slug,
                fn($q) =>
                $q->where(function ($sub) {
                    $sub->where('judul', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                })
            )
            ->latest()
            ->paginate($this->slug ? 1 : $this->perPage);

        if ($this->slug && $downloads->isEmpty()) {
            abort(404);
        }

        $item = $this->slug ? $downloads->first() : null;

        $meta = [
            'title' => $item?->judul ?? 'Download',
            'description' => Str::limit(strip_tags(
                $item?->description ?? config('app.description')
            ), 160),
            'image' => SeoHelper::image($item?->image ?? null),
            'canonical' => url()->current(),
            'og_type' => $item ? 'article' : 'website',
        ];

        return view('livewire.portal.download', [
            'downloads' => $downloads,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
