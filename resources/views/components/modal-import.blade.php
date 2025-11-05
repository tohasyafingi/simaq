@props([
    'id',
    'title' => 'Import Excel',
    'inputName' => 'file'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" wire:submit.prevent="import">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="{{ $id }}Input" class="form-label">Pilih file Excel (.xls/.xlsx)</label>
                    <input class="form-control @error($inputName) is-invalid @enderror"
                           type="file"
                           id="{{ $id }}Input"
                           wire:model="{{ $inputName }}"
                           accept=".xls,.xlsx">
                    @error($inputName)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary me-auto" wire:click.prevent="downloadTemplate">
                    <i class="fas fa-file-download"></i> Download Template
                </button>
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4">Import</button>
            </div>
        </form>
    </div>
</div>
