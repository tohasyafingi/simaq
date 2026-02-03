<div class="container-fluid">
    <!-- Content Header -->
    <div class="app-content-header mb-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i> {{$title}} {{ $rombel->nama }}</h3>
            </div>
            <div class="col-12 col-md-6">
                <ol class="breadcrumb float-md-end">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.admin.rombel.index') }}">Rombel</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $rombel->nama }}</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Form Tambah Siswa -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tambah Siswa</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="addSiswa">

                <div class="row mb-3 align-items-start">
                    <!-- Dropdown Pilih Siswa -->
                    <label class="form-label">Pilih Siswa</label>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group local-forms"
                            wire:ignore
                            wire:key="container-select-siswa-{{ count($siswaList) }}"
                            id="select-siswa-container">
                            <select id="select-siswa" class="form-control" multiple>
                                @foreach($siswaList as $siswa)
                                <option value="{{ $siswa->id }}">
                                    {{ $siswa->nis }} - {{ $siswa->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <x-form-error field="siswa_ids" />
                    </div>
                    <!-- Tombol Tambah Siswa -->
                    <div class="col-12 col-md-2 d-flex justify-content-md-start justify-content-center">
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">Tambah Siswa</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Siswa dalam Rombel -->
    <div class="card">
        <div class="card-header">
            <h5>Siswa dalam Rombel: {{ $rombel->nama }}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="row mb-3 align-items-end">
                    <div class="col-12 col-md-2 mb-3 mb-md-0">
                        <label for="paginate" class="form-label">Tampilkan</label>
                        <select wire:model.live="paginateSiswa" id="paginate" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input wire:model.live="searchSiswa" type="text" class="form-control" placeholder="Cari siswa...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Siswa -->
            <div class="table-responsive">
                <table class="table table-hover table-striped table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach($siswaInRombel as $index => $siswa)
                        <tr>
                            <td class="text-center">{{ $siswaInRombel->firstItem() + $index }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $siswa->pivot->status ? 'success' : 'danger' }}">
                                    {{ $siswa->pivot->status ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button wire:click="updateStatus({{ $siswa->id }}, {{ $siswa->pivot->status ? '0' : '1' }})"
                                        class="btn btn-sm btn-outline-success me-2">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                    <button wire:click="deleteSiswa({{ $siswa->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $siswaInRombel->links() }}
        </div>
    </div>
    @script
    <script>
        document.addEventListener('livewire:navigated', () => {
            initSelect2Siswa();
        });

        function _setLivewirePropertyFromElement(element, prop, value) {
            try {
                var wrapper = element.closest('[wire\\:id]');
                if (!wrapper) return;
                var id = wrapper.getAttribute('wire:id');
                if (!id) return;
                if (window.Livewire && typeof window.Livewire.find === 'function') {
                    window.Livewire.find(id).set(prop, value);
                }
            } catch (e) {
                console.warn('Livewire set failed', e);
            }
        }

        function initSelect2Siswa() {
            // Hancurkan instance lama sebelum membuat yang baru
            if ($('#select-siswa').hasClass("select2-hidden-accessible")) {
                $('#select-siswa').select2('destroy');
            }

            $('#select-siswa').select2({
                placeholder: "Pilih Siswa",
                allowClear: true,
                width: '100%'
            });

            $('#select-siswa').on('change', function() {
                _setLivewirePropertyFromElement(this, 'siswa_ids', $(this).val());
            });
        }

        $wire.on('resetSelect2Siswa', () => {
            $('#select-siswa').val(null).trigger('change');
        });

        /* === TAMBAHKAN BAGIAN INI AGAR REALTIME === */
        $wire.on('refreshSelect2', () => {
            // Beri jeda 100ms agar Livewire selesai update DOM sebelum Select2 membaca ulang <option>
            setTimeout(() => {
                initSelect2Siswa();
            }, 100);
        });
    </script>
    @endscript

</div>
