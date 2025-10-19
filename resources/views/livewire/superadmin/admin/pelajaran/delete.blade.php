<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <div class="mb-3">
                        <h5 class="text-center text-danger fw-bold">Apakah Anda yakin ingin menghapus modul berikut?
                        </h5>
                    </div>

                    <div class="container">
                        <div class="row">
                            <!-- Nama Modul -->
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <div class="col-md-4 fw-semibold text-secondary">Nama Modul</div>
                                    <div class="col-md-8">: {{$nama}}</div>
                                </div>
                            </div>

                            <!-- Pelajaran -->
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <div class="col-md-4 fw-semibold text-secondary">Pelajaran</div>
                                    <div class="col-md-8">: {{$pelajaran_nama ?? '-'}}</div>
                                </div>
                            </div>

                            <!-- Tingkat -->
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <div class="col-md-4 fw-semibold text-secondary">Tingkat</div>
                                    <div class="col-md-8">: {{ $item->tingkat ?? '-' }}</div>
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <div class="col-md-4 fw-semibold text-secondary">Jurusan</div>
                                    <div class="col-md-8">: {{$jurusan_nama ?? '-'}}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-md">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>