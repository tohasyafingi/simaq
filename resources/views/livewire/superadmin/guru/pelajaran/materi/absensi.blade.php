<div>
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a wire:navigate
                        href="{{ routeRoleBased('pelajaran.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}"
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a wire:navigate
                                href="{{ routeRoleBased('pelajaran.materi.index', ['guruPelajaranId' => $guruPelajaranId, 'rombelId' => $rombelId]) }}">Materi</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Absensi</li>
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

                    <div class="mb-4">
                        <h6><strong>Judul Materi:</strong> {{ $materi->judul ?? '-' }}</h6>
                        <h6><strong>Tanggal Materi:</strong> {{ $materi->tanggal ?? '-' }}</h6>
                        <h6><strong>Waktu Materi:</strong> {{ $materi->jam ?? '-' }}</h6>
                    </div>

                    <!-- TABEL ABSENSI -->
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped table-sm align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">NIS</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">Rombel</th>
                                        <th colspan="4">Status Kehadiran</th>
                                    </tr>
                                    <tr>
                                        <th>Hadir</th>
                                        <th>Izin</th>
                                        <th>Sakit</th>
                                        <th>Alfa</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @php $no = 1; @endphp
                                    @foreach($rombel->siswaAktif as $siswa)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->name }}</td>
                                            <td class="text-center">{{ $rombel->nama }}</td>

                                            @foreach(['Hadir', 'Izin', 'Sakit', 'Alfa'] as $statusOption)
                                                @php
                                                    $isSelected = isset($absensi[$siswa->id]) && $absensi[$siswa->id] === $statusOption;
                                                    $statusClass = $isSelected ? 'bg-' . strtolower($statusOption) : 'bg-none';
                                                @endphp

                                                <td class="text-center" style="cursor: pointer;"
                                                    wire:click="setAbsensi({{ $siswa->id }}, '{{ $statusOption }}')">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check">
                                                            <input type="radio" name="absensi-{{ $siswa->id }}"
                                                                id="absensi-{{ $siswa->id }}-{{ $statusOption }}"
                                                                class="form-check-input d-none" @if($isSelected) checked @endif>

                                                            <label for="absensi-{{ $siswa->id }}-{{ $statusOption }}"
                                                                class="border rounded d-flex justify-content-center align-items-center {{ $statusClass }}"
                                                                style="width:24px; height:24px;">
                                                                @if($isSelected)
                                                                    <i class="fas fa-check text-white small"></i>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach
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

</div>