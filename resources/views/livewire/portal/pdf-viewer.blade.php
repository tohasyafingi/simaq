<div class="news-detail-page py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            {{-- Judul --}}
            <h1 class="fw-bold mb-2 text-center">{{ $book->judul }}</h1>

            @if($book->description)
            <p class="text-center text-muted mb-4 small">
                {{ $book->description }}
            </p>
            @endif

            @if($pdfUrl)
            <div class="pdf-wrapper rounded overflow-hidden border">

                <iframe
                    id="pdfViewerIframe"
                    src="about:blank"
                    data-src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}#zoom=page-width"
                    class="pdf-iframe"
                    loading="lazy"
                    title="PDF Viewer">
                </iframe>

                <noscript>
                    <iframe
                        src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}"
                        class="pdf-iframe"
                        title="PDF Viewer">
                    </iframe>
                </noscript>

            </div>
            @else
            <div class="alert alert-warning text-center my-5">
                File PDF belum tersedia.
            </div>
            @endif

        </div>
    </div>

    <style>
        .pdf-wrapper {
            position: relative;
            width: 100%;
            height: 80vh;
            background: #f8f9fa;
        }

        /* Desktop besar */
        @media (min-width: 992px) {
            .pdf-wrapper {
                height: 85vh;
            }
        }

        /* Mobile */
        @media (max-width: 576px) {
            .pdf-wrapper {
                height: 75vh;
            }
        }

        .pdf-iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>

    <script>
        (function() {
            const iframe = document.getElementById('pdfViewerIframe');
            if (!iframe) return;

            function loadIframe() {
                const src = iframe.getAttribute('data-src');
                if (src) {
                    iframe.src = src;
                    iframe.removeAttribute('data-src');
                }
            }

            if ('IntersectionObserver' in window) {
                // Lazy loading dengan IntersectionObserver
                const io = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            loadIframe();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    rootMargin: '300px' // preload sedikit sebelum terlihat
                });
                io.observe(iframe);
            } else {
                // fallback untuk browser lama
                window.addEventListener('load', loadIframe);
            }
        })();
    </script>
</div>
