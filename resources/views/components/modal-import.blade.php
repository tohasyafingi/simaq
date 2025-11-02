@props([
    'id',
    'title' => 'Import Excel',
    'routeImport',
    'routeTemplate' => null,
    'inputName' => 'file'
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="{{ $routeImport }}" method="POST" enctype="multipart/form-data" class="modal-content" id="{{ $id }}Form">
            @csrf
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
                           name="{{ $inputName }}"
                           accept=".xls,.xlsx"
                           required
                           onchange="previewFileName('{{ $id }}')">
                    @error($inputName)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="{{ $id }}FilenamePreview" class="small text-muted"></div>
            </div>

            <div class="modal-footer">
                @if ($routeTemplate)
                    <a href="{{ $routeTemplate }}" class="btn btn-outline-primary me-auto">
                        <i class="fas fa-file-download"></i> Download Template
                    </a>
                @endif
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-4">Import</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Function to preview the selected file name
    function previewFileName(modalId) {
        const input = document.querySelector(`#${modalId}Input`);
        const preview = document.querySelector(`#${modalId}FilenamePreview`);
        if (input && input.files.length > 0) {
            preview.textContent = `File dipilih: ${input.files[0].name}`;
        } else {
            preview.textContent = '';
        }
    }

    // Automatically open the modal if there's a validation error
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->has($inputName))
            var modal = new bootstrap.Modal(document.getElementById('{{ $id }}'));
            modal.show();
        @endif
    });
</script>
@endpush
