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
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingJurusan">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseJurusan"
                                            aria-expanded="false" aria-controls="collapseJurusan">
                                            <strong>Program Jurusan</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseJurusan" class="accordion-collapse collapse"
                                        aria-labelledby="headingJurusan" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <!-- Kiri: Form Tambah/Edit Jurusan -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0" id="formTitleJurusan">Tambah
                                                                Jurusan</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form id="jurusanForm">
                                                                <input type="hidden" id="jurusanId">
                                                                <div class="mb-3">
                                                                    <label for="jurusanImage" class="form-label">Upload
                                                                        Gambar</label>
                                                                    <input type="file" class="form-control"
                                                                        id="jurusanImage" accept="image/*">
                                                                    <img id="previewJurusan" src=""
                                                                        class="img-fluid mt-2 d-none"
                                                                        style="max-height:150px;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jurusanTitle" class="form-label">Judul
                                                                        Jurusan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="jurusanTitle" placeholder="Nama Jurusan">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jurusanDescription"
                                                                        class="form-label">Deskripsi Singkat</label>
                                                                    <textarea class="form-control"
                                                                        id="jurusanDescription" rows="5"></textarea>
                                                                </div>
                                                                <div id="jurusanButtons" class="d-flex gap-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kanan: Tabel List Jurusan -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0">Daftar Jurusan</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-striped"
                                                                id="tableJurusan">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">No</th>
                                                                        <th>Judul</th>
                                                                        <th>Deskripsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr data-id="1" data-title="Teknik Informatika"
                                                                        data-description="Jurusan fokus pada pemrograman dan teknologi informasi."
                                                                        data-image="jurusan1.jpg"
                                                                        style="cursor:pointer">
                                                                        <td>1</td>
                                                                        <td>Teknik Informatika</td>
                                                                        <td>Jurusan fokus pada pemrograman dan teknologi
                                                                            informasi.</td>
                                                                    </tr>
                                                                    <tr data-id="2" data-title="Akuntansi"
                                                                        data-description="Jurusan fokus pada pengelolaan keuangan dan laporan akuntansi."
                                                                        data-image="jurusan2.jpg"
                                                                        style="cursor:pointer">
                                                                        <td>2</td>
                                                                        <td>Akuntansi</td>
                                                                        <td>Jurusan fokus pada pengelolaan keuangan dan
                                                                            laporan akuntansi.</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingEkstrakurikuler">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseEkstrakurikuler"
                                            aria-expanded="false" aria-controls="collapseEkstrakurikuler">
                                            <strong>Ekstrakurikuler</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseEkstrakurikuler" class="accordion-collapse collapse"
                                        aria-labelledby="headingEkstrakurikuler" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <!-- Kiri: Form Tambah/Edit Ekstrakurikuler -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0" id="formTitleEkstra">Tambah
                                                                Ekstrakurikuler</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <form id="ekstraForm">
                                                                <input type="hidden" id="ekstraId">

                                                                <div class="mb-3">
                                                                    <label for="ekstraImage" class="form-label">Upload
                                                                        Gambar</label>
                                                                    <input type="file" class="form-control"
                                                                        id="ekstraImage" accept="image/*">
                                                                    <img id="previewEkstra" src=""
                                                                        class="img-fluid mt-2 d-none"
                                                                        style="max-height:150px;">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="ekstraTitle" class="form-label">Nama
                                                                        Ekstrakurikuler</label>
                                                                    <input type="text" class="form-control"
                                                                        id="ekstraTitle"
                                                                        placeholder="Nama Ekstrakurikuler">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="ekstraDescription"
                                                                        class="form-label">Deskripsi Singkat</label>
                                                                    <textarea class="form-control"
                                                                        id="ekstraDescription" rows="5"></textarea>
                                                                </div>

                                                                <div id="ekstraButtons" class="d-flex gap-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kanan: Tabel List Ekstrakurikuler -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-title mb-0">Daftar Ekstrakurikuler</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-striped"
                                                                id="tableEkstra">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">No</th>
                                                                        <th>Nama</th>
                                                                        <th>Deskripsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr data-id="1" data-title="Pramuka"
                                                                        data-description="Kegiatan pramuka untuk membentuk karakter siswa."
                                                                        data-image="pramuka.jpg" style="cursor:pointer">
                                                                        <td>1</td>
                                                                        <td>Pramuka</td>
                                                                        <td>Kegiatan pramuka untuk membentuk karakter
                                                                            siswa.</td>
                                                                    </tr>
                                                                    <tr data-id="2" data-title="Paduan Suara"
                                                                        data-description="Membina kemampuan bernyanyi dan performa kelompok."
                                                                        data-image="paduan_suara.jpg"
                                                                        style="cursor:pointer">
                                                                        <td>2</td>
                                                                        <td>Paduan Suara</td>
                                                                        <td>Membina kemampuan bernyanyi dan performa
                                                                            kelompok.</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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

    <script>
        const jurusanForm = document.getElementById('jurusanForm');
        const formTitleJurusan = document.getElementById('formTitleJurusan');
        const jurusanId = document.getElementById('jurusanId');
        const jurusanTitle = document.getElementById('jurusanTitle');
        const jurusanDescription = document.getElementById('jurusanDescription');
        const jurusanImage = document.getElementById('jurusanImage');
        const previewJurusan = document.getElementById('previewJurusan');
        const jurusanButtons = document.getElementById('jurusanButtons');
        const tableJurusan = document.getElementById('tableJurusan').querySelector('tbody');

        // Preview gambar
        jurusanImage.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                previewJurusan.src = URL.createObjectURL(file);
                previewJurusan.classList.remove('d-none');
            }
        });

        // Klik baris tabel → form edit
        tableJurusan.querySelectorAll('tr').forEach((row, index) => {
            row.addEventListener('click', () => {
                jurusanId.value = row.dataset.id;
                jurusanTitle.value = row.dataset.title;
                jurusanDescription.value = row.dataset.description;
                previewJurusan.src = row.dataset.image;
                previewJurusan.classList.remove('d-none');

                formTitleJurusan.textContent = "Edit Jurusan";
                jurusanButtons.innerHTML = `
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-danger" onclick="deleteJurusan('${row.dataset.id}')">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="resetJurusanForm()">Batal</button>
            `;
            });
        });

        function resetJurusanForm() {
            jurusanForm.reset();
            jurusanId.value = '';
            previewJurusan.classList.add('d-none');
            formTitleJurusan.textContent = "Tambah Jurusan";
            jurusanButtons.innerHTML = `<button type="submit" class="btn btn-primary">Simpan</button>`;
        }

        function deleteJurusan(id) {
            if (confirm("Yakin hapus jurusan ini?")) {
                const row = tableJurusan.querySelector(`tr[data-id="${id}"]`);
                row.remove();
                resetJurusanForm();
            }
        }
    </script>
    <script>
        const ekstraForm = document.getElementById('ekstraForm');
        const formTitleEkstra = document.getElementById('formTitleEkstra');
        const ekstraId = document.getElementById('ekstraId');
        const ekstraTitle = document.getElementById('ekstraTitle');
        const ekstraDescription = document.getElementById('ekstraDescription');
        const ekstraImage = document.getElementById('ekstraImage');
        const previewEkstra = document.getElementById('previewEkstra');
        const ekstraButtons = document.getElementById('ekstraButtons');
        const tableEkstra = document.getElementById('tableEkstra').querySelector('tbody');

        // Preview gambar
        ekstraImage.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                previewEkstra.src = URL.createObjectURL(file);
                previewEkstra.classList.remove('d-none');
            }
        });

        // Klik baris tabel → form edit
        tableEkstra.querySelectorAll('tr').forEach((row, index) => {
            row.addEventListener('click', () => {
                ekstraId.value = row.dataset.id;
                ekstraTitle.value = row.dataset.title;
                ekstraDescription.value = row.dataset.description;
                previewEkstra.src = row.dataset.image;
                previewEkstra.classList.remove('d-none');

                formTitleEkstra.textContent = "Edit Ekstrakurikuler";
                ekstraButtons.innerHTML = `
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-danger" onclick="deleteEkstra('${row.dataset.id}')">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="resetEkstraForm()">Batal</button>
            `;
            });
        });

        function resetEkstraForm() {
            ekstraForm.reset();
            ekstraId.value = '';
            previewEkstra.classList.add('d-none');
            formTitleEkstra.textContent = "Tambah Ekstrakurikuler";
            ekstraButtons.innerHTML = `<button type="submit" class="btn btn-primary">Simpan</button>`;
        }

        function deleteEkstra(id) {
            if (confirm("Yakin hapus ekstrakurikuler ini?")) {
                const row = tableEkstra.querySelector(`tr[data-id="${id}"]`);
                row.remove();
                resetEkstraForm();
            }
        }
    </script>
</div>