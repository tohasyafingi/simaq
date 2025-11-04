<div class="news-page">

    <div class="page-header">
        <div class="container">
            <h1 class="display-4 fw-bold">News & Announcements</h1>
            <p class="lead">Stay updated with the latest news and events from our school</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8">
                @forelse($beritas as $berita)
                    <div class="card news-card">
                        <img src="{{ $berita->thumbnail_url ?? asset('portal/images/default.jpg') }}" class="news-image"
                            alt="{{ $berita->judul }}">
                        <div class="card-body">
                            <span class="news-category">{{ $berita->kategori->nama ?? 'Uncategorized' }}</span>
                            <p class="news-date"><i class="bi bi-calendar3"></i> January 15, 2025</p>
                            <h3 class="card-title">{{ $berita->judul }}</h3>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120, '...') !!}
                            </p>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark me-2"><i class="bi bi-eye"></i> 1,234 views</span>
                                <span class="badge bg-light text-dark"><i class="bi bi-chat"></i> 45 comments</span>
                            </div>
                            <a href="{{ route('detail-berita-agenda', ['slug' => $berita->slug]) }}"
                                class="btn btn-read-more mt-3">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada berita publik tersedia.</p>
                @endforelse
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="mb-0"><i class="bi bi-megaphone"></i> Important Announcements</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Jan 20,
                                    2025</small>
                                <p class="mb-1"><strong>Semester Exam Schedule Released</strong></p>
                                <small class="text-muted">Final exams will begin on February 5th. Check the academic
                                    portal for your personalized schedule.</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Jan 18,
                                    2025</small>
                                <p class="mb-1"><strong>Parent-Teacher Meeting</strong></p>
                                <small class="text-muted">Mandatory meeting on January 25th at 2 PM in the school
                                    auditorium to discuss student progress.</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Jan 15,
                                    2025</small>
                                <p class="mb-1"><strong>School Holiday Notice</strong></p>
                                <small class="text-muted">School will be closed on January 22-23 for staff professional
                                    development.</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Jan 12,
                                    2025</small>
                                <p class="mb-1"><strong>New Admission Period Opens</strong></p>
                                <small class="text-muted">Applications for 2025-2026 academic year now open. Limited
                                    spots available.</small>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Jan 8,
                                    2025</small>
                                <p class="mb-1"><strong>Library Extended Hours</strong></p>
                                <small class="text-muted">Digital library now open until 8 PM on weekdays to support
                                    exam preparation.</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Upcoming Events</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Feb 5,
                                    2025</small>
                                <p class="mb-1"><strong>Annual Sports Day</strong></p>
                                <small class="text-muted">Inter-house athletics competition featuring track and field
                                    events.</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Feb 10,
                                    2025</small>
                                <p class="mb-1"><strong>Science Fair Exhibition</strong></p>
                                <small class="text-muted">Student science projects on display. Open to parents and
                                    community.</small>
                            </li>
                            <li class="mb-3 pb-3 border-bottom">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Feb 15,
                                    2025</small>
                                <p class="mb-1"><strong>Art & Music Festival</strong></p>
                                <small class="text-muted">Showcasing student artwork and musical performances.</small>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted d-block mb-1"><i class="bi bi-calendar3"></i> Feb 20,
                                    2025</small>
                                <p class="mb-1"><strong>Career Guidance Workshop</strong></p>
                                <small class="text-muted">University representatives and career counselors for senior
                                    students.</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
                        <h5 class="mb-0"><i class="bi bi-trophy"></i> Recent Achievements</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-star-fill text-warning"></i> National Science Competition -
                                1st Place</li>
                            <li class="mb-2"><i class="bi bi-star-fill text-warning"></i> Regional Math Olympiad - 2nd
                                Place</li>
                            <li class="mb-2"><i class="bi bi-star-fill text-warning"></i> Debate Championship - Finalist
                            </li>
                            <li class="mb-2"><i class="bi bi-star-fill text-warning"></i> Basketball Tournament -
                                Champions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>