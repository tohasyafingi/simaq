<div>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="bi bi-person-fill sm-1"></i>{{$title}}</h3>
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
                                {{-- <div class="col-md-6">
                                    <label for="tahun_ajaran_id" class="form-label fw-bold">Tahun Ajaran</label>
                                    <select wire:model.live="tahun_ajaran_id" id="tahun_ajaran_id" class="form-select">
                                        @foreach($tahunAjarans as $ta)
                                        <option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body">
                            @if(!$rombel)
                                <div class="alert alert-warning">
                                    Siswa ini tidak terdaftar dalam rombel pada tahun ajaran yang dipilih.
                                </div>
                            @else
                                @forelse($materis as $materi)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <strong>{{ $materi->judul }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text p-0">Deskripsi: {{ $materi->deskripsi ?? '-' }}
                                            </p>
                                            @if($materi->file)
                                                <p class="card-text p-0">Berkas:
                                                    <a href="{{ asset('storage/' . $materi->file) }}" target="_blank"
                                                        class="text-decoration-underline">
                                                        Lihat File
                                                    </a>
                                                </p>
                                            @endif
                                            <p class="card-text p-0">Waktu:
                                                {{ \Carbon\Carbon::parse($materi->tanggal)->translatedFormat('d F Y') }}
                                                {{ $materi->jam }}
                                            </p>
                                            <a href="{{ routeRoleBased('pelajaran.materi.absensi', [$siswa->id, $pelajaranId, $materi->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Absensi
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info">Belum ada materi pada pelajaran ini.</div>
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