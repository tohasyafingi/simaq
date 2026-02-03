<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Tambah {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Nama -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Nama Modul <span class="text-danger">*</span></label>
                            <input wire:model="nama" type="text" class="form-control" placeholder="Masukkan nama modul">
                            <x-form-error field="nama" />
                        </div>

                        <!-- Pelajaran -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Pelajaran <span class="text-danger">*</span></label>
                            <select wire:model="pelajaran_id" class="form-control">
                                <option value="">Pilih Pelajaran</option>
                                @foreach($pelajarans as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nama }} - {{ $p->tingkatKelas->tingkat ?? '-' }} -
                                        {{ $p->jurusan->nama ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-form-error field="pelajaran_id" />
                        </div>

                        <!-- Link -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Link Modul</label>
                            <input wire:model="link" type="url" class="form-control" placeholder="Masukkan link modul">
                            <x-form-error field="link" />
                        </div>

                        <!-- File -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">File Modul</label>
                            <input wire:model="file" type="file" class="form-control" accept=".pdf,application/pdf">
                            @include('components.upload-loading', ['target' => 'file'])
                            @include('components.upload-preview', ['file' => $file])
                            <x-form-error field="file" />

                            {{-- file preview handled by component above --}}
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 py-2">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <x-form-error field="status" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
