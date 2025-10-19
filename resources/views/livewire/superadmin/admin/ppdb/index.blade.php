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
                            <!-- Langsung tampilkan form tanpa accordion -->
                            <h4 class="mb-3"><strong>PPDB</strong></h4>
                            <form action="/profil/ppdb" method="POST" enctype="multipart/form-data">
                                <!-- Upload Gambar -->
                                <div class="mb-3">
                                    <label for="ppdbImage" class="form-label">Upload Gambar</label>
                                    <input class="form-control" type="file" id="ppdbImage"
                                        name="ppdbImage" accept="image/*">
                                </div>

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label for="ppdbTitle" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="ppdbTitle"
                                        name="ppdbTitle" placeholder="Judul PPDB">
                                </div>

                                <!-- Deskripsi Singkat -->
                                <div class="mb-3">
                                    <label for="ppdbDescription" class="form-label">Deskripsi
                                        Singkat</label>
                                    <textarea id="ppdbDescription" name="ppdbDescription"
                                        class="form-control" rows="5"></textarea>
                                </div>

                                <!-- Link -->
                                <div class="mb-3">
                                    <label for="ppdbLink" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="ppdbLink" name="ppdbLink"
                                        placeholder="https://example.com">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </div> <!-- end app-content -->
    <!-- CKEditor -->
<script>
    ClassicEditor.create(document.querySelector('#ppdbDescription')).catch(error => console.error(error));
</script>

</div> <!-- end wrapper -->