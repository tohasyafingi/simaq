<div>
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a wire:navigate href="{{ route('superadmin.admin.guru-pengajar.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('superadmin.admin.guru-pengajar.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}">Materi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Absensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{$title}} - Rombel: {{ $rombel->nama }}</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped table-sm align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">NIS</th>
                                    <th rowspan="2">Nama</th>
                                    <th colspan="{{ $materis->count() }}">Pertemuan</th>
                                    <th colspan="4">Jumlah</th>
                                </tr>
                                <tr class="text-center">
                                    @foreach($materis as $materi)
                                    <th>{{ \Carbon\Carbon::parse($materi->tanggal)->format('d/m') }}</th>
                                    @endforeach
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                    <th>Sakit</th>
                                    <th>Alfa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($rombel->siswaAktif as $siswa)
                                @php
                                $count = ['Hadir'=>0, 'Izin'=>0, 'Sakit'=>0, 'Alfa'=>0];
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->name }}</td>

                                    @foreach($materis as $materi)
                                    @php
                                    $absensi = $materi->absensis->firstWhere('siswa_id', $siswa->id);
                                    $status = $absensi->status_kehadiran ?? '-';
                                    if($status && $status != '-') {
                                    $count[$status] = ($count[$status] ?? 0) + 1;
                                    }
                                    @endphp
                                    <td class="text-center">{{ $status }}</td>
                                    @endforeach

                                    <td class="text-center">{{ $count['Hadir'] }}</td>
                                    <td class="text-center">{{ $count['Izin'] }}</td>
                                    <td class="text-center">{{ $count['Sakit'] }}</td>
                                    <td class="text-center">{{ $count['Alfa'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>