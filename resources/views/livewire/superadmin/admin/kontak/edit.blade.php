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

                        <!-- Alamat -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Alamat</label>
                                <textarea wire:model="alamat" class="form-control" rows="2" placeholder="Masukkan alamat"></textarea>
                                <x-form-error field="alamat" />
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Telepon</label>
                                <input wire:model="telepon" type="text" class="form-control" placeholder="Masukkan telepon">
                                <x-form-error field="telepon" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Email</label>
                                <input wire:model="email" type="email" class="form-control" placeholder="Masukkan email">
                                <x-form-error field="email" />
                            </div>
                        </div>

                        <!-- Google Map Embed -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Google Map Embed</label>
                                <textarea wire:model="google_map_embed" class="form-control" rows="2" placeholder="Masukkan embed map"></textarea>
                                <x-form-error field="google_map_embed" />
                            </div>
                        </div>

                        <!-- Media Sosial -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Facebook</label>
                                <input wire:model="facebook" type="text" class="form-control" placeholder="Masukkan link Facebook">
                                <x-form-error field="facebook" />
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Instagram</label>
                                <input wire:model="instagram" type="text" class="form-control" placeholder="Masukkan link Instagram">
                                <x-form-error field="instagram" />
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Tiktok</label>
                                <input wire:model="tiktok" type="text" class="form-control" placeholder="Masukkan link Tiktok">
                                <x-form-error field="tiktok" />
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Twitter</label>
                                <input wire:model="twitter" type="text" class="form-control" placeholder="Masukkan link Twitter">
                                <x-form-error field="twitter" />
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Youtube</label>
                                <input wire:model="youtube" type="text" class="form-control" placeholder="Masukkan link Youtube">
                                <x-form-error field="youtube" />
                            </div>
                        </div>

                        <!-- About -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Tentang</label>
                                <textarea wire:model="about" class="form-control" rows="3" placeholder="Masukkan tentang"></textarea>
                                <x-form-error field="about" />
                            </div>
                        </div>

                        <!-- Copyright -->
                        {{-- <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Copyright</label>
                                <input wire:model="copyright" type="text" class="form-control" placeholder="Masukkan copyright">
                                <x-form-error field="copyright" />
                            </div>
                        </div> --}}

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
