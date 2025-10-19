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
                                <!-- OSIS -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOsis">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOsis"
                                            aria-expanded="false" aria-controls="collapseOsis">
                                            <strong>OSIS</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOsis" class="accordion-collapse collapse"
                                        aria-labelledby="headingOsis" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="/profil/osis" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="osisImage" class="form-label">Upload Gambar</label>
                                                    <input class="form-control" type="file" id="osisImage"
                                                        name="osisImage" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="osisContent" class="form-label">Konten OSIS</label>
                                                    <textarea id="osisContent" name="osisContent" class="form-control"
                                                        rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pramuka -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPramuka">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePramuka"
                                            aria-expanded="false" aria-controls="collapsePramuka">
                                            <strong>Pramuka</strong>
                                        </button>
                                    </h2>
                                    <div id="collapsePramuka" class="accordion-collapse collapse"
                                        aria-labelledby="headingPramuka" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="/profil/pramuka" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="pramukaImage" class="form-label">Upload Gambar</label>
                                                    <input class="form-control" type="file" id="pramukaImage"
                                                        name="pramukaImage" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pramukaContent" class="form-label">Konten
                                                        Pramuka</label>
                                                    <textarea id="pramukaContent" name="pramukaContent"
                                                        class="form-control" rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Program Tahfidz -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTahfidz">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTahfidz"
                                            aria-expanded="false" aria-controls="collapseTahfidz">
                                            <strong>Program Tahfidz</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseTahfidz" class="accordion-collapse collapse"
                                        aria-labelledby="headingTahfidz" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <form action="/profil/tahfidz" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="tahfidzImage" class="form-label">Upload Gambar</label>
                                                    <input class="form-control" type="file" id="tahfidzImage"
                                                        name="tahfidzImage" accept="image/*">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tahfidzContent" class="form-label">Konten Program
                                                        Tahfidz</label>
                                                    <textarea id="tahfidzContent" name="tahfidzContent"
                                                        class="form-control" rows="6"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
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
    ClassicEditor.create(document.querySelector('#osisContent')).catch(error => console.error(error));
    ClassicEditor.create(document.querySelector('#pramukaContent')).catch(error => console.error(error));
    ClassicEditor.create(document.querySelector('#tahfidzContent')).catch(error => console.error(error));
</script>


</div>