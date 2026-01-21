@props(['target' => 'file', 'label' => ''])

{{-- 
    1. Tambahkan style="display: none;" secara manual untuk memastikan 
       ia tersembunyi saat pertama kali halaman dimuat. 
    2. Hapus .delay jika Anda ingin spinner langsung muncul saat klik/upload.
--}}
<div wire:loading wire:target="{{ $target }}" 
     class="align-items-center" 
     style="display: none; gap: 6px; margin-top: 2px;">
    
    <div class="spinner-border text-secondary" 
         role="status" 
         aria-hidden="true" 
         style="width: 0.85rem; height: 0.85rem; border-width: 0.15em;">
    </div>

    @if($label)
        <span class="text-secondary" style="font-size: 0.75rem; line-height: 1;">{{ $label }}</span>
    @endif
</div>