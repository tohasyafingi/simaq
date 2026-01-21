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
                src="{{ asset('pdfjs/web/viewer.html') }}?file={{ urlencode($pdfUrl) }}"
                style="border: none; width: 100%; height: 100%; flex-grow: 1;"></iframe>
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
</div>