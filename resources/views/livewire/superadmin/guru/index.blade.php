<div class="app-content">
    <!-- Header -->
    <div class="app-content-header bg-light py-3 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3>Selamat Datang, {{ auth()->user()->name }}!</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <ol class="breadcrumb mb-0">
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Boxes -->
    <div class="container-fluid flex-fill d-flex flex-column">
        <div class="row g-3 mb-4">
            @php
                $boxes = [
                    ['Jumlah Rombel', $jumlah_rombel, '#3b82f6', 'bi-people-fill'],
                    ['Jumlah Pelajaran', $jumlah_pelajaran, '#f59e0b', 'bi-book-fill'],
                    ['Status', $status_guru, '#10b981', 'bi-person-check-fill'],
                ];
            @endphp

            @foreach($boxes as $box)
                <div class="col-12 col-sm-6 col-md-4">
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

        <!-- Kalender & Pengumuman -->
        <div class="row g-3">
            <div class="col-lg-8 col-md-12 d-flex">
                <div class="card p-3 flex-fill d-flex flex-column min-vh-50">
                    <h5>Kalender Kegiatan</h5>
                    <div id="calendar" style="flex: 1 1 auto; min-height: 400px;"></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card p-3 h-100">
                    <h5>Pengumuman</h5>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        events: @json($events),
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