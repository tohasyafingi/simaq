<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Tambah {{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <!-- Nama Pelajaran -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Nama Pelajaran <span class="text-danger">*</span></label>
                                <input wire:model="nama" class="form-control" type="text"
                                    placeholder="Masukkan nama pelajaran" />
                                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Kode Pelajaran -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Kode Pelajaran <span class="text-danger">*</span></label>
                                <input wire:model="kd_pelajaran" class="form-control" type="text"
                                    placeholder="Masukkan kode pelajaran" />
                                @error('kd_pelajaran') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Jurusan -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Jurusan <span class="text-danger">*</span></label>
                                <select wire:model="jurusan_id" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="all">Semua Jurusan</option>
                                    @foreach($jurusans as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                                    @endforeach
                                </select>

                                @error('jurusan_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <!-- Tingkat Kelas -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Tingkat Kelas <span class="text-danger">*</span></label>
                                <select wire:model="tingkat_kelas_id" class="form-control">
                                    <option value="">Pilih Tingkat Kelas</option>
                                    <option value="all">Semua Tingkat Kelas</option>
                                    @foreach($tingkat_kelas as $tk)
                                        <option value="{{ $tk->id }}">{{ $tk->tingkat }}</option>
                                    @endforeach
                                </select>
                                @error('tingkat_kelas_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Status <span class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
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