@props(['file' => null, 'label' => '', 'maxHeight' => '120px'])
@php
    use Illuminate\Support\Str;
    $imageExts = ['jpg','jpeg','png','gif','bmp','webp','svg'];
    $isString = is_string($file);
@endphp

@if($file)
    <div class="mt-2">
        @if($isString)
            @php
                $url = Str::startsWith($file, ['http://','https://']) ? $file : asset('storage/' . ltrim($file, '/'));
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            @endphp
            @if(in_array($ext, $imageExts))
                <img src="{{ $url }}" class="img-fluid rounded" style="max-height:{{ $maxHeight }};" />
            @elseif($ext === 'pdf')
                <a href="{{ $url }}" target="_blank" class="badge bg-info">Lihat PDF</a>
            @else
                <a href="{{ $url }}" target="_blank" class="badge bg-info">Unduh / Lihat file</a>
            @endif
        @else
            @php
                try {
                    $ext = strtolower($file->getClientOriginalExtension() ?? '');
                } catch (\Throwable $e) {
                    $ext = '';
                }
            @endphp
            @if(in_array($ext, $imageExts))
                <img src="{{ $file->temporaryUrl() }}" class="img-fluid rounded" style="max-height:{{ $maxHeight }};" />
            @else
                <span class="badge bg-info">{{ $file->getClientOriginalName() }}</span>
            @endif
        @endif
    </div>
@endif
