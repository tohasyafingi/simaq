<div class="d-flex flex-column min-vh-100">
    <section class="hero-section bg-dark text-white d-flex align-items-center" style="height: 150px;">
        <div class="container text-center">
            <h1>{{ $book->judul }}</h1>
        </div>
    </section>

    @if($pdfUrl)
    <section class="pdf-viewer-section flex-grow-1 bg-secondary d-flex">
        <div class="container-fluid p-0 flex-grow-1 d-flex">
            <iframe
                id="pdfViewerIframe"
                src="about:blank"
                data-src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}"
                loading="lazy"
                style="border: none; width: 100%; height: 100%; flex-grow: 1;"></iframe>

            <noscript>
                <iframe
                    src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}"
                    style="border: none; width: 100%; height: 100%; flex-grow: 1;"></iframe>
            </noscript>

        </div>
        @else
        <div class="alert alert-warning text-center m-5">
            File PDF belum tersedia.
        </div>
        @endif
    </section>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
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
                const io = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            loadIframe();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { rootMargin: '200px' });
                io.observe(iframe);
            } else {
                // fallback: load after DOM ready
                if (document.readyState === 'complete' || document.readyState === 'interactive') {
                    loadIframe();
                } else {
                    document.addEventListener('DOMContentLoaded', loadIframe);
                }
            }
        })();
    </script>
</div>