@if($show)
<div class="modal fade show d-block"
     tabindex="-1"
     style="background: rgba(0,0,0,.55);">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg position-relative"
             style="border-radius: 18px;">

            {{-- Close (X) Button --}}
            <button type="button"
                    {{ $attributes->whereStartsWith('wire:') }}
                    class="btn position-absolute top-0 end-0 m-3 p-1"
                    style="background: transparent; border: none; color:#6c757d;">
                <i class="fas fa-times fs-5"></i>
            </button>

            {{-- Header --}}
            <div class="modal-header flex-column text-center"
                 style="background: linear-gradient(135deg, #e0f7f1, #ffffff);
                        border-bottom: none;
                        padding: 2.25rem 1.5rem 1.25rem;">
                
                <img src="{{ asset('assets/logo.webp') }}"
                     alt="Logo SIMAQ"
                     style="width:64px;"
                     class="mb-3">

                <h5 class="fw-bold d-flex align-items-center justify-content-center gap-2 mb-0"
                    style="color:#16a085;">
                    MA TAKHASSUS AL-QUR'AN WONOSOBO
                </h5>
            </div>

            {{-- Body --}}
            <div class="modal-body text-center px-4 pt-3 pb-2">
                <h5 class="fw-bold d-flex align-items-center justify-content-center gap-2 mb-0"
                    style="color:#16a085;">
                    <i class="fas fa-shield-alt"></i>
                    Peringatan Keamanan Akun
                </h5>
                <p class="mb-3" style="color:#333; line-height:1.6;">
                    Demi menjaga keamanan akun Anda, sistem mendeteksi bahwa password
                    yang digunakan masih merupakan <strong>password default</strong>.
                </p>

                <p class="mb-0" style="color:#555; font-size:0.95rem;">
                    Untuk melindungi data pribadi dan mencegah akses tidak sah,
                    kami menyarankan Anda segera mengganti password.
                </p>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 pt-3 pb-4 px-4">
                <a href="{{ route('profil.show') }}"
                   class="btn w-100 d-flex justify-content-center align-items-center gap-2"
                   style="background-color:#1abc9c; color:#fff; font-weight:500;">
                    <i class="fas fa-key"></i>
                    Ganti Password Sekarang
                </a>
            </div>

        </div>
    </div>
</div>
@endif
