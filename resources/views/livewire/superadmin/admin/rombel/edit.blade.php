<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Nama Rombel -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Nama Rombel <span class="text-danger">*</span></label>
                                <input type="text" wire:model="nama" class="form-control" placeholder="Masukkan Nama Rombel" required>
                                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tingkat Kelas -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Tingkat Kelas <span class="text-danger">*</span></label>
                                <select wire:model="tingkat_kelas_id" class="form-control" required>
                                    <option value="">Pilih Tingkat Kelas</option>
                                    @foreach($tingkatKelas as $tingkat)
                                    <option value="{{ $tingkat->id }}">{{ $tingkat->tingkat }}</option>
                                    @endforeach
                                </select>
                                @error('tingkat_kelas_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Jurusan -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Jurusan</label>
                                <select wire:model="jurusan_id" class="form-control">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Ruang Kelas -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Ruang Kelas</label>
                                <select wire:model="ruang_kelas_id" class="form-control">
                                    <option value="">Pilih Ruang Kelas</option>
                                    @foreach($ruangKelas as $ruang)
                                    <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_kelas_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tahun Ajaran Aktif -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Tahun Ajaran Aktif</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $tahunAjaranAktif->tahun ?? 'Tidak Ada Tahun Ajaran Aktif' }} - {{ $tahunAjaranAktif->semester }}">
                                <input type="hidden" wire:model="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id ?? '' }}">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Status <span class="text-danger">*</span></label>
                                <select wire:model="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>