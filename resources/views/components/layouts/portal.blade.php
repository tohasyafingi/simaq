<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  @include('components.layouts.meta')

  {{-- Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32.png')}}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16.png')}}" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png')}}" />
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon-192.png')}}" />
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/icon-512.png')}}" />
  <meta name="theme-color" content="#ffffff">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


  <link rel="stylesheet" href="{{ asset('code/assets/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

  @livewireStyles

  <style>
    /* Preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      /* pastikan menutupi seluruh layar */
      z-index: 999999;
      display: flex;
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(10px);
      /* blur halaman di belakang */
      background-color: rgba(255, 255, 255, 0.3);
      /* transparan */
      transition: opacity 200ms ease, visibility 200ms ease;
    }

    #preloader.hidden {
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
    }

    /* Gambar preloader */
    #preloader img {
      max-width: 150px;
      /* ukuran maksimal */
      width: 20vw;
      /* responsive width */
      height: auto;
      display: block;
    }

    /* Mobile adjustments */
    @media (max-width: 576px) {
      #preloader img {
        width: 30vw;
        /* lebih kecil di mobile */
        max-width: 100px;
      }
    }
  </style>
</head>

<body>

  <!-- Preloader -->
  <div id="preloader" aria-hidden="true">
    <img src="{{ asset('assets/logo.webp') }}" alt="Loading" aria-hidden="true" />
  </div>

  @include('components.layouts.portal.header')

  {{ $slot }}

  @include('components.layouts.portal.footer')

  <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script data-navigate-once src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script data-navigate-once src="{{ asset('code/assets/js/main.js') }}"></script>
  <script>
    /**
     * FUNGSI UTAMA PRELOADER
     */
    if (!window.handlePreloader) {
      window.handlePreloader = (isInitialLoad = false) => {
        const preloader = document.getElementById('preloader');
        if (!preloader) return;

        // Cek apakah sudah pernah muncul di sesi ini
        const hasSeenPreloader = sessionStorage.getItem('preloader_seen');

        if (isInitialLoad && !hasSeenPreloader) {
          // Tampilkan preloader hanya pada load pertama
          window.addEventListener('load', () => {
            setTimeout(() => {
              preloader.classList.add('hidden');
              sessionStorage.setItem('preloader_seen', 'true');
              setTimeout(() => preloader.remove(), 300);
            }, 500); // Beri jeda sedikit agar logo terlihat
          });
        } else {
          // Jika navigasi wire:navigate atau sudah pernah lihat, hapus instan
          preloader.style.display = 'none';
          preloader.remove();
        }
      };
    }

    /**
     * FUNGSI AOS
     */
    if (!window.initAOS) {
      window.initAOS = () => {
        if (typeof AOS !== 'undefined') {
          AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic',
            offset: 120,
          });
        }
      };
    }

    // 1. Eksekusi saat Full Load / Hard Refresh
    window.handlePreloader?.(true);
    window.initAOS?.();

    // 2. Eksekusi saat perpindahan halaman via wire:navigate
    document.addEventListener('livewire:navigated', () => {
      // Kita tidak panggil preloader di sini agar navigasi terasa instan
      window.handlePreloader?.(false);
      window.initAOS?.();

      // Memastikan scroll kembali ke atas setiap pindah halaman
      window.scrollTo(0, 0);
    });

    // 3. Refresh AOS untuk konten dinamis
    document.addEventListener('livewire:initialized', () => {
      Livewire.hook('morph.updated', () => {
        if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
          AOS.refresh();
        }
      });
    });
  </script>
  @livewireScripts
</body>

</html>