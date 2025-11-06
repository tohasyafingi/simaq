<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-book"></i>{{$title}}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></i> Dashboard</a></li>
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
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row g-3 align-items-center">
                                <!-- Info Siswa -->
                                <div class="col-md-6">
                                    <div class="border p-3 rounded bg-light">
                                        <p class="mb-1"><strong>Nama:</strong> {{ $siswa->name }}</p>
                                        @if($rombel)
                                            <p class="mb-0"><strong>Rombel:</strong> {{ $rombel->nama }}</p>
                                        @else
                                            <p class="text-muted mb-0">Tidak terdaftar dalam rombel</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Filter Tahun Ajaran -->
                                <div class="col-md-6">
                                    <label for="tahun_ajaran_id" class="form-label fw-bold">Tahun Ajaran</label>
                                    <select wire:model.live="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                        @foreach($tahunAjarans as $ta)
                                            <option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            @if(!$rombel)
                                <div class="alert alert-warning">
                                    Siswa ini tidak terdaftar dalam rombel pada tahun ajaran yang dipilih.
                                </div>
                            @else
                                @forelse($pelajarans as $pelajaran)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <strong>{{ $pelajaran->nama }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text p-0">Guru: {{ $pelajaran->guru }}</p>
                                            <a href="{{ routeRoleBased('pelajaran.materi.index', ['siswaId' => $siswa->id, 'pelajaranId' => $pelajaran->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                {{ $pelajaran->jumlah_materi }} Materi 
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info">Tidak ada mata pelajaran ditemukan untuk rombel ini.</div>
                                @endforelse
                            @endif
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::App Content-->
</div>