<div class="app-content">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Selamat Datang, {{ $nama_admin }}!</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <!-- Info Boxes Utama -->
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

        <!-- Kalender Kiri & Info Boxes Kanan -->
        <div class="row g-3">
            <!-- Kalender -->
            <div class="col-lg-6 col-md-12 d-flex">
                <div class="card p-3 flex-fill d-flex flex-column">
                    <h5>Kalender Kegiatan</h5>
                    <div id="calendar" style="flex: 1 1 auto; min-height: 400px;"></div>
                    <!-- Tambah min-height untuk fallback -->
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card p-3 h-100">
                    <!-- <h5>Pengumuman</h5> -->
                    <div></div>
                </div>
            </div>
            <!-- Info Boxes Kanan -->
            <div class="col-lg-3 col-md-12">
                @php
                    $rightBoxes = [
                        ['Tahun Ajaran', $tahun_ajaran, '#6366f1', 'bi-calendar-event'],
                        ['Jurusan', $jumlah_jurusan, '#3b82f6', 'bi-building'],
                        ['Ruang Kelas', $jumlah_ruang_kelas, '#10b981', 'bi-door-closed'],
                        ['Pengajar', $jumlah_pengajar, '#f59e0b', 'bi-person-badge'],
                        ['Rombel', $jumlah_rombel, '#f43f5e', 'bi-people'],
                    ];
                @endphp
                @foreach($rightBoxes as $box)
                    <div class="card mb-3 p-3" style="background:{{ $box[2] }}; color:white;">
                        <div class="d-flex align-items-center">
                            <i class="bi {{ $box[3] }} fs-2 me-3"></i>
                            <div>
                                <div>{{ $box[0] }}</div>
                                <div class="fs-5 fw-bold">{{ $box[1] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Scripts FullCalendar -->
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/id.global.min.js"></script>

<script>
document.addEventListener('livewire:load', function () {
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            height: '100%',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hari Ini',
                month: 'Bulan',
                week: 'Minggu',
                day: 'Hari',
                list: 'Agenda'
            },
            events: @json($events ?? []),
            editable: false,
            selectable: false,
            themeSystem: 'bootstrap5'
        });
        calendar.render();
    }
});
</script>
@endpush

</div>