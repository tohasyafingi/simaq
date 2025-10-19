<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="bi bi-person-fill sm-1"></i> {{$title}}
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Kolom kiri: Form input/edit kategori -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" id="form-title">Tambah Kategori</h5>
                        </div>
                        <div class="card-body">
                            <form id="kategori-form">
                                <input type="hidden" id="editIndex">
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="nama_kategori"
                                        placeholder="Masukkan nama kategori" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug_kategori" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug_kategori"
                                        placeholder="Slug kategori" required>
                                </div>
                                <div id="form-buttons">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan: List data kategori -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">List Kategori</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="kategori-table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                    </tr>
                                </thead>
                                <tbody id="kategori-list">
                                    <!-- Data kategori akan muncul di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End kolom kanan -->
            </div>
        </div>
    </div>
    <!--end::App Content-->
    <script>
        let kategori = [];
        const form = document.getElementById('kategori-form');
        const namaInput = document.getElementById('nama_kategori');
        const slugInput = document.getElementById('slug_kategori');
        const kategoriList = document.getElementById('kategori-list');
        const formTitle = document.getElementById('form-title');
        const formButtons = document.getElementById('form-buttons');
        const editIndex = document.getElementById('editIndex');

        // Render list kategori
        function renderKategori() {
            kategoriList.innerHTML = '';
            if (kategori.length === 0) {
                kategoriList.innerHTML = `<tr><td colspan="3" class="text-center">Belum ada data kategori</td></tr>`;
                return;
            }
            kategori.forEach((item, index) => {
                const row = document.createElement('tr');
                row.style.cursor = "pointer"; // kasih efek pointer
                row.setAttribute("onclick", `editKategori(${index})`);
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.nama}</td>
                <td>${item.slug}</td>
            `;
                kategoriList.appendChild(row);
            });
        }

        // Tambah atau update kategori
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const nama = namaInput.value.trim();
            const slug = slugInput.value.trim();
            if (!nama || !slug) return;

            if (editIndex.value === '') {
                // mode tambah
                kategori.push({ nama, slug });
            } else {
                // mode edit
                kategori[editIndex.value] = { nama, slug };
            }

            resetForm();
            renderKategori();
        });

        // Edit kategori
        function editKategori(index) {
            namaInput.value = kategori[index].nama;
            slugInput.value = kategori[index].slug;
            editIndex.value = index;
            formTitle.textContent = 'Edit Kategori';
            formButtons.innerHTML = `
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            <button type="button" class="btn btn-danger" onclick="deleteKategori(${index})"><i class="fas fa-trash"></i> Hapus</button>
            <button type="button" class="btn btn-secondary" onclick="resetForm()"><i class="fas fa-times"></i> Batal</button>
        `;
        }

        // Hapus kategori
        function deleteKategori(index) {
            if (confirm('Yakin hapus kategori ini?')) {
                kategori.splice(index, 1);
                resetForm();
                renderKategori();
            }
        }

        // Reset form ke mode tambah
        function resetForm() {
            namaInput.value = '';
            slugInput.value = '';
            editIndex.value = '';
            formTitle.textContent = 'Tambah Kategori';
            formButtons.innerHTML = `
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        `;
        }

        // Inisialisasi
        renderKategori();
    </script>
</div>