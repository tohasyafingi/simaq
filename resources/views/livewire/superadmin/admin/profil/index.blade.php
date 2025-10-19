<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i>{{$title}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-1">
                                <div>
                                    <h3>Lengkapi data berikut</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <!-- Sejarah -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSejarah">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSejarah"
                                            aria-expanded="false" aria-controls="collapseSejarah">
                                            <strong>Sejarah</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseSejarah" class="accordion-collapse collapse"
                                        aria-labelledby="headingSejarah" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="/profil/sejarah" method="POST" enctype="multipart/form-data">
                                                <!-- Upload gambar -->
                                                <div class="mb-3">
                                                    <label for="sejarahImage" class="form-label">Upload Gambar</label>
                                                    <input class="form-control" type="file" id="sejarahImage"
                                                        name="sejarahImage" accept="image/*">
                                                </div>
                                                <!-- Text Editor -->
                                                <div class="mb-3">
                                                    <label for="sejarahContent" class="form-label">Konten
                                                        Sejarah</label>
                                                    <textarea id="sejarahContent" name="sejarahContent"
                                                        class="form-control" rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Visi & Misi -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingVisiMisi">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseVisiMisi"
                                            aria-expanded="false" aria-controls="collapseVisiMisi">
                                            <strong>Visi & Misi</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseVisiMisi" class="accordion-collapse collapse"
                                        aria-labelledby="headingVisiMisi" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="/profil/visi-misi" method="POST"
                                                enctype="multipart/form-data">
                                                <!-- Upload gambar -->
                                                <div class="mb-3">
                                                    <label for="visiMisiImage" class="form-label">Upload Gambar</label>
                                                    <input class="form-control" type="file" id="visiMisiImage"
                                                        name="visiMisiImage" accept="image/*">
                                                </div>
                                                <!-- Visi -->
                                                <div class="mb-3">
                                                    <label for="visiContent" class="form-label">Visi</label>
                                                    <textarea id="visiContent" name="visiContent" class="form-control"
                                                        rows="4"></textarea>
                                                </div>
                                                <!-- Misi -->
                                                <div class="mb-3">
                                                    <label for="misiContent" class="form-label">Misi</label>
                                                    <textarea id="misiContent" name="misiContent" class="form-control"
                                                        rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Struktur Organisasi -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingStruktur">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseStruktur"
                                            aria-expanded="false" aria-controls="collapseStruktur">
                                            <strong>Struktur Organisasi Sekolah</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseStruktur" class="accordion-collapse collapse"
                                        aria-labelledby="headingStruktur" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <!-- Kiri: Form Upload/Edit -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0" id="formTitle">Tambah Anggota
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form id="strukturForm" enctype="multipart/form-data">
                                                                <input type="hidden" id="anggotaId" name="anggotaId">

                                                                <div class="mb-3">
                                                                    <label for="strukturFoto"
                                                                        class="form-label">Foto</label>
                                                                    <input type="file" class="form-control"
                                                                        id="strukturFoto" name="strukturFoto"
                                                                        accept="image/*">
                                                                    <img id="previewFoto" src="" alt=""
                                                                        class="img-fluid mt-2 d-none"
                                                                        style="max-height:150px;">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="strukturNama"
                                                                        class="form-label">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="strukturNama" name="strukturNama"
                                                                        placeholder="Nama lengkap">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="strukturJabatan"
                                                                        class="form-label">Jabatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="strukturJabatan" name="strukturJabatan"
                                                                        placeholder="Contoh: Kepala Sekolah">
                                                                </div>

                                                                <div id="formButtons" class="d-flex gap-2">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save"></i> Simpan
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kanan: List Anggota -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0">Daftar Anggota</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">No</th>
                                                                        <th>Nama</th>
                                                                        <th>Jabatan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="listAnggota">
                                                                    <tr data-id="1" data-nama="Budi"
                                                                        data-jabatan="Kepala Sekolah"
                                                                        data-foto="foto1.jpg">
                                                                        <td>1</td>
                                                                        <td>Budi</td>
                                                                        <td>Kepala Sekolah</td>
                                                                    </tr>
                                                                    <tr data-id="2" data-nama="Siti"
                                                                        data-jabatan="Wakil Kepala Sekolah"
                                                                        data-foto="foto2.jpg">
                                                                        <td>2</td>
                                                                        <td>Siti</td>
                                                                        <td>Wakil Kepala Sekolah</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Kanan -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end accordion -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </div> <!-- end app-content -->

    <!-- CKEditor CDN -->
    <script>
        ClassicEditor.create(document.querySelector('#sejarahContent')).catch(error => console.error(error));
        ClassicEditor.create(document.querySelector('#visiContent')).catch(error => console.error(error));
        ClassicEditor.create(document.querySelector('#misiContent')).catch(error => console.error(error));
    </script>

    <!-- Script Struktur Organisasi -->
    <script>
        const form = document.getElementById('strukturForm');
        const formTitle = document.getElementById('formTitle');
        const formButtons = document.getElementById('formButtons');
        const anggotaId = document.getElementById('anggotaId');
        const namaInput = document.getElementById('strukturNama');
        const jabatanInput = document.getElementById('strukturJabatan');
        const fotoInput = document.getElementById('strukturFoto');
        const previewFoto = document.getElementById('previewFoto');
        const listAnggota = document.getElementById('listAnggota');

        // Klik baris -> masuk ke mode edit
        listAnggota.querySelectorAll('tr').forEach(row => {
            row.style.cursor = "pointer";
            row.addEventListener('click', () => {
                anggotaId.value = row.dataset.id;
                namaInput.value = row.dataset.nama;
                jabatanInput.value = row.dataset.jabatan;
                if (row.dataset.foto) {
                    previewFoto.src = row.dataset.foto;
                    previewFoto.classList.remove('d-none');
                } else {
                    previewFoto.classList.add('d-none');
                }

                formTitle.textContent = "Edit Anggota";
                formButtons.innerHTML = `
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                <button type="button" class="btn btn-danger" onclick="deleteAnggota('${row.dataset.id}')"><i class="fas fa-trash"></i> Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fas fa-times"></i> Batal</button>
            `;
            });
        });

        // Reset form
        function resetForm() {
            anggotaId.value = "";
            namaInput.value = "";
            jabatanInput.value = "";
            fotoInput.value = "";
            previewFoto.classList.add('d-none');
            formTitle.textContent = "Tambah Anggota";
            formButtons.innerHTML = `
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        `;
        }

        // Dummy delete (bisa disesuaikan backend)
        function deleteAnggota(id) {
            if (confirm("Yakin hapus anggota ini?")) {
                document.querySelector(`#listAnggota tr[data-id="${id}"]`).remove();
                resetForm();
            }
        }

        // Preview foto
        fotoInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                previewFoto.src = URL.createObjectURL(file);
                previewFoto.classList.remove("d-none");
            }
        });
    </script>
</div>