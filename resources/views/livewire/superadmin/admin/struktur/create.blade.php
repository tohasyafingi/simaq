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
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Nama <span class="text-danger">*</span></label>
                                <select wire:model="user_id" class="form-control">
                                    <option value="">Pilih Nama</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                                    @endforeach
                                </select>
                                @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Jabatan <span class="text-danger">*</span></label>
                                <input wire:model="jabatan" type="text" class="form-control"
                                    placeholder="Masukkan jabatan">
                                @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Urutan -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Urutan <span class="text-danger">*</span></label>
                                <input wire:model="urutan" type="number" class="form-control"
                                    placeholder="Masukkan urutan">
                                @error('urutan') <small class="text-danger">{{ $message }}</small> @enderror
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