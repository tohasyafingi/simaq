<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fas fa-tags"></i> {{$title}}
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $editMode ? 'Edit Kategori' : 'Tambah Kategori' }}</h5>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="store">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" wire:model.defer="nama"
                                        placeholder="Masukkan nama kategori">
                                    @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" wire:model.defer="slug"
                                        placeholder="Slug kategori">
                                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ $editMode ? 'Update' : 'Simpan' }}
                                </button>
                                @if($editMode)
                                    <button type="button" class="btn btn-secondary" wire:click="resetForm">Batal</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">List Kategori</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kategoris as $index => $kat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kat->nama }}</td>
                                            <td>{{ $kat->slug }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-success"
                                                    wire:click="edit({{ $kat->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="delete({{ $kat->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data kategori</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->

</div>