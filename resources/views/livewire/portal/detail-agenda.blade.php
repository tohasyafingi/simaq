<div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita-agenda') }}">News</a></li>
                        <li class="breadcrumb-item active">{{ $berita->judul }}</li>
                    </ol>
                </nav>

                <article class="detail-header">
                    <span class="news-category">{{ $berita->kategori->nama ?? 'Uncategorized' }}</span>
                    <h1 class="display-5 fw-bold mb-3">{{ $berita->judul }}</h1>

                    <div class="detail-meta">
                        <div class="detail-meta-item">
                            <i class="bi bi-calendar3 text-primary"></i>
                            <span>{{ $berita->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-meta-item">
                            <i class="bi bi-person text-primary"></i>
                            <span>{{ $berita->author_name ?? 'Admin' }}</span>
                        </div>
                        <div class="detail-meta-item">
                            <i class="bi bi-eye text-primary"></i>
                            <span>1,234 views</span>
                        </div>
                        <div class="detail-meta-item">
                            <i class="bi bi-chat text-primary"></i>
                            <span>45 comments</span>
                        </div>
                    </div>

                    <img src="{{ $berita->thumbnail_url ?? asset('portal/images/default.jpg') }}"
                        alt="{{ $berita->judul }}" class="detail-image">
                </article>

                <div class="detail-content">
                    <p class="lead">
                        {!! $berita->isi !!}
                    </p>
                </div>

                <div class="author-info">
                    <img src="{{ asset('portal/images/default.jpg') }}" alt="Author" class="author-avatar">
                    <div class="author-details">
                        <h5>{{ $berita->author_name ?? 'Admin' }}</h5>
                        <p class="mb-0 text-muted">Official news and updates from our school administration</p>
                    </div>
                </div>
                <div class="d-flex gap-2 my-4">
                    <span class="fw-bold">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        class="text-primary"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(request()->fullUrl()) }}"
                        class="text-primary"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}"
                        target="_blank" title="Share to WhatsApp" class="text-primary"><i
                            class="bi bi-whatsapp"></i></a>
                    <a href="javascript:void(0);" onclick="copyLink()" class="text-primary"><i
                            class="bi bi-link-45deg"></i></a>
                </div>

                <div class="comments-section">
                    <h3 class="mb-4">Comments (45)</h3>

                    <div class="comment">
                        <div class="comment-header">
                            <span class="comment-author">John Smith</span>
                            <span class="comment-date">January 16, 2025</span>
                        </div>
                        <p class="mb-0">Congratulations to the team! This is such an inspiring achievement. Our school
                            continues to produce exceptional students.</p>
                    </div>

                    <div class="comment">
                        <div class="comment-header">
                            <span class="comment-author">Emily Johnson</span>
                            <span class="comment-date">January 16, 2025</span>
                        </div>
                        <p class="mb-0">As a parent, I'm so proud of what our students have accomplished. This shows the
                            quality of education our children are receiving.</p>
                    </div>

                    <div class="comment">
                        <div class="comment-header">
                            <span class="comment-author">Michael Chen</span>
                            <span class="comment-date">January 15, 2025</span>
                        </div>
                        <p class="mb-0">Amazing work! The renewable energy project sounds fascinating. Best of luck at
                            the international competition!</p>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Leave a Comment</h5>
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="4" placeholder="Your Comment"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-read-more">Post Comment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-newspaper"></i> Related News</h5>
                    </div>

                    <div class="card-body">
                        @foreach($latestBeritas as $latest)
                            <div class="related-item">
                                <img src="{{ $latest->thumbnail_url ?? asset('portal/images/default.jpg') }}"
                                    alt="{{ $latest->judul }}">
                                <div class="related-item-content">
                                    <h6><a href="{{ route('detail-berita-agenda', ['slug' => $latest->slug]) }}"
                                            class="text-dark">{{ $latest->judul }}</a></h6>
                                    <small><i class="bi bi-calendar3"></i>
                                        {{ $latest->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-tags"></i> Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">Achievement</span>
                            <span class="badge bg-secondary">Event</span>
                            <span class="badge bg-success">Facility</span>
                            <span class="badge bg-info">Community</span>
                            <span class="badge bg-warning">Academic</span>
                        </div>
                    </div>
                </div>

                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Upcoming Events</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <small class="text-muted d-block"><i class="bi bi-calendar3"></i> Feb 5, 2025</small>
                                <strong>Annual Sports Day</strong>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted d-block"><i class="bi bi-calendar3"></i> Feb 10, 2025</small>
                                <strong>Science Fair Exhibition</strong>
                            </li>
                            <li class="mb-3">
                                <small class="text-muted d-block"><i class="bi bi-calendar3"></i> Feb 15, 2025</small>
                                <strong>Art & Music Festival</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyLink() {
            const url = window.location.href;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link berhasil disalin: ' + url);
                }).catch(err => {
                    alert('Gagal menyalin link');
                });
            } else {
                // fallback untuk browser lama
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                try {
                    document.execCommand('copy');
                    alert('Link berhasil disalin: ' + url);
                } catch (err) {
                    alert('Browser Anda tidak mendukung fitur ini, silakan salin link secara manual.');
                }
                document.body.removeChild(tempInput);
            }
        }
    </script>
</div>