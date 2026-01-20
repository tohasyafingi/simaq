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
                                @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Telepon</label>
                                <input wire:model="telepon" type="text" class="form-control" placeholder="Masukkan telepon">
                                @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Email</label>
                                <input wire:model="email" type="email" class="form-control" placeholder="Masukkan email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Google Map Embed -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Google Map Embed</label>
                                <textarea wire:model="google_map_embed" class="form-control" rows="2" placeholder="Masukkan embed map"></textarea>
                                @error('google_map_embed') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Media Sosial -->
                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Facebook</label>
                                <input wire:model="facebook" type="text" class="form-control" placeholder="Masukkan link Facebook">
                                @error('facebook') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Twitter</label>
                                <input wire:model="twitter" type="text" class="form-control" placeholder="Masukkan link Twitter">
                                @error('twitter') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Instagram</label>
                                <input wire:model="instagram" type="text" class="form-control" placeholder="Masukkan link Instagram">
                                @error('instagram') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 py-2">
                            <div class="form-group local-forms">
                                <label>Youtube</label>
                                <input wire:model="youtube" type="text" class="form-control" placeholder="Masukkan link Youtube">
                                @error('youtube') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- About -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Tentang</label>
                                <textarea wire:model="about" class="form-control" rows="3" placeholder="Masukkan tentang"></textarea>
                                @error('about') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="col-12 py-2">
                            <div class="form-group local-forms">
                                <label>Copyright</label>
                                <input wire:model="copyright" type="text" class="form-control" placeholder="Masukkan copyright">
                                @error('copyright') <small class="text-danger">{{ $message }}</small> @enderror
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