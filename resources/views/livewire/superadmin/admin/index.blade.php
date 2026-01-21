<div class="app-content">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Selamat Datang, {{ $nama_admin }}!</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end"></ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">

        <!-- Baris 1: Info Boxes Utama (4 per baris) -->
        <div class="row g-3 mb-4">
            @php
            $boxes = [
            ['Guru', $jumlah_guru, '#3b82f6', 'bi-person-badge-fill'],
            ['Bendahara', $jumlah_bendahara, '#10b981', 'bi-wallet2'],
            ['Tata Usaha', $jumlah_tu, '#f59e0b', 'bi-briefcase'],
            ['Siswa', $jumlah_siswa, '#ef4444', 'bi-people'],
            ];
            @endphp

            @foreach($boxes as $box)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box p-3 rounded-2 d-flex align-items-center"
                    style="background:{{ $box[2] }}; color:white;">
                    <i class="bi {{ $box[3] }} fs-2 me-3"></i>
                    <div>
                        <div>{{ $box[0] }}</div>
                        <div class="fs-5 fw-bold">{{ $box[1] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Baris 2: Right Boxes (4 per baris) -->
        <div class="row g-3 mb-4">
            @php
            $rightBoxes = [
            ['Tahun Ajaran', $tahun_ajaran, '#6366f1', 'bi-calendar-event'],
            ['Jurusan', $jumlah_jurusan, '#3b82f6', 'bi-building'],
            ['Pengajar', $jumlah_pengajar, '#f59e0b', 'bi-person-badge'],
            ['Rombel', $jumlah_rombel, '#f43f5e', 'bi-people'],
            ];
            @endphp

            @foreach($rightBoxes as $box)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card p-3" style="background:{{ $box[2] }}; color:white;">
                    <div class="d-flex align-items-center">
                        <i class="bi {{ $box[3] }} fs-2 me-3"></i>
                        <div>
                            <div>{{ $box[0] }}</div>
                            <div class="fs-5 fw-bold">{{ $box[1] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    <x-modal-password-warning
        :show="$showPasswordModal"
        wire:click="$set('showPasswordModal', false)" />
</div>