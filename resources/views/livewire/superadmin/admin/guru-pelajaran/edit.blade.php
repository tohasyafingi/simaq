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
                        <!-- Guru -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Guru <span class="text-danger">*</span></label>
                                <select wire:model="guru_id" class="form-control">
                                    <option value="">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                                @error('guru_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Pelajaran -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Pelajaran <span class="text-danger">*</span></label>
                                <select wire:model="pelajaran_id" class="form-control">
                                    <option value="">Pilih Pelajaran</option>
                                    @foreach($pelajarans as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nama }}
                                        @if($p->tingkatKelas) - {{ $p->tingkatKelas->tingkat }} @endif
                                        @if($p->jurusan) - {{ $p->jurusan->nama }} @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('pelajaran_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Tahun Ajaran Aktif -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Tahun Ajaran Aktif</label>
                                @if($tahunAjaranAktif)
                                <input type="text" class="form-control" disabled
                                    value="{{ $tahunAjaranAktif->tahun }} - {{ $tahunAjaranAktif->semester }}">
                                @else
                                <div class="alert alert-warning mb-0 py-2">
                                    Tidak ada tahun ajaran aktif!
                                </div>
                                @endif
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
                    <button type="submit" class="btn btn-warning btn-md">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>