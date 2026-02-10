<div class="news-detail-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="fw-bold mb-3 text-center" data-aos="fade-up" data-aos-duration="800">{{ $karyaIlmiah->judul }}</h1>
                <div class="text-center text-muted mb-4 small">
                    <i class="fas fa-calendar-alt"></i> {{ $karyaIlmiah->created_at->format('d M Y') }} &nbsp; | &nbsp;
                    <i class="fas fa-user"></i> {{ $karyaIlmiah->author ?? 'Siswa' }} &nbsp; | &nbsp;
                    <i class="fas fa-tag"></i> {{ $karyaIlmiah->kategori->nama ?? 'Umum' }}
                </div>
                <div class="news-thumbnail mb-4" data-aos="zoom-in">
                                      <img src="{{ \App\Helpers\ImageHelper::url($karyaIlmiah->thumbnail) ?? asset('assets/karya.webp') }}"
                        alt="{{ $karyaIlmiah->judul }}" loading="lazy" class="w-100 rounded shadow-sm news-image">
                </div>
                <div class="news-content mb-4" data-aos="fade-up" data-aos-delay="80">
                    {!! $karyaIlmiah->isi !!}
                </div>

            </div>
            <div class="col-lg-8">
                <div
                    class="share-section d-flex align-items-center justify-content-between border-top border-bottom py-3 my-4">
                    <span class="fw-bold text-uppercase text-secondary small">Bagikan Artikel:</span>
                    <div class="d-flex gap-2 flex-wrap justify-content-end">

                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($canonical ?? request()->fullUrl()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-social btn-facebook"
                            title="Bagikan ke Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a
                            href="https://twitter.com/intent/tweet?text={{ urlencode($karyaIlmiah->judul) }}&url={{ urlencode($canonical ?? request()->fullUrl()) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-social btn-twitter"
                            title="Bagikan ke Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>

                        <a
                            href="https://api.whatsapp.com/send?text={{ urlencode($karyaIlmiah->judul . ' ' . ($canonical ?? request()->fullUrl())) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-sm btn-social btn-whatsapp"
                            title="Bagikan ke WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>

                        <button
                            type="button"
                            onclick="nativeShare()"
                            class="btn btn-sm btn-social btn-native"
                            title="Bagikan ke aplikasi">
                            <i class="bi bi-share-fill"></i>
                        </button>

                        <button
                            type="button"
                            onclick="copyLink()"
                            class="btn btn-sm btn-social btn-link"
                            title="Salin tautan">
                            <i class="bi bi-link-45deg"></i>
                        </button>
                    </div>
                </div>
                <div class="author-box d-flex align-items-center border rounded p-3 bg-light">
                    <img src="{{ asset('assets/default-image.webp') }}" alt="Author" loading="lazy" class="rounded-circle me-3"
                        style="width:40px; height:40px; object-fit:cover;">
                    <div>
                        <h6 class="mb-1">{{ $karyaIlmiah->author ?? 'Admin Sekolah' }}</h6>
                        <!-- <small class="text-muted">Official student research and innovation</small> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (!window.SHARE_DATA) {
            window.SHARE_DATA = {
                title: "{{ addslashes($fullTitle ?? $karyaIlmiah->judul) }}",
                text: "{{ addslashes($description ?? $karyaIlmiah->judul) }}",
                url: "{{ $canonical ?? request()->fullUrl() }}",
            };
        }

        if (!window.nativeShare) {
            window.nativeShare = function() {
                if (navigator.share) {
                    navigator.share(window.SHARE_DATA)
                        .catch(err => console.warn('Share dibatalkan', err));
                } else {
                    window.copyLink(true);
                }
            };
        }

        if (!window.copyLink) {
            window.copyLink = function(fromShare = false) {
                const url = window.SHARE_DATA.url;

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(url).then(() => {
                        alert(fromShare ?
                            'Browser tidak mendukung share.\nLink disalin.' :
                            'Link berhasil disalin.'
                        );
                    });
                } else {
                    const temp = document.createElement('input');
                    temp.value = url;
                    document.body.appendChild(temp);
                    temp.select();
                    document.execCommand('copy');
                    document.body.removeChild(temp);

                    alert(fromShare ?
                        'Browser tidak mendukung share.\nLink disalin.' :
                        'Link berhasil disalin.'
                    );
                }
            };
        }
    </script>
</div>