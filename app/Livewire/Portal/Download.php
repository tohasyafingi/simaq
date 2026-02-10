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
    public $perPage = 6;
    public $selectedDownload;

    public function mount($slug = null)
    {
        if ($slug) {
            $item = Downloads::where('status', 1)
                ->get()
                ->first(function ($download) use ($slug) {
                    $itemSlug = $download->slug ?? Str::slug($download->judul);
                    return $itemSlug === $slug;
                });
            abort_if(!$item, 404);
            $this->selectedDownload = $item;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDownloadBySlug($slug)
    {
        return Downloads::where('status', 1)
            ->get()
            ->first(function ($item) use ($slug) {
                $itemSlug = $item->slug ?? Str::slug($item->judul);
                return $itemSlug === $slug;
            });
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

        $title = $this->selectedDownload?->judul ?? 'Download';
        $description = $this->selectedDownload?->description
            ?? config('app.description', 'Download file dan dokumen MA Takhassus Al-Qur’an Wonosobo');
        $image = SeoHelper::image($this->selectedDownload?->image ?? null);

        $meta = [
            'title' => $title,
            'description' => Str::limit(strip_tags($description), 160),
            'image' => $image,
            'canonical' => url()->current(),
            'og_type' => $this->selectedDownload ? 'article' : 'website',
        ];

        return view('livewire.portal.download', [
            'downloads' => $downloads,
        ])->layout('components.layouts.portal', ['meta' => $meta]);
    }
}
