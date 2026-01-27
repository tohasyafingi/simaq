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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

  @livewireStyles
</head>

<body>
  @include('components.layouts.portal.header')

  {{ $slot }}

  @include('components.layouts.portal.footer')

  <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script data-navigate-once src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script data-navigate-once src="{{ asset('code/assets/js/main.js') }}"></script>
  <script>
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
    window.handlePreloader?.(true);
    window.initAOS?.();

    document.addEventListener('livewire:navigated', () => {
      window.handlePreloader?.(false);
      window.initAOS?.();

      window.scrollTo(0, 0);
    });

    document.addEventListener('livewire:initialized', () => {
      Livewire.hook('morph.updated', () => {
        if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
          AOS.refresh();
        }
      });
    });
  </script>
  <script>
    document.addEventListener('contextmenu', e => {
      if (e.target.tagName === 'IMG') e.preventDefault();
    });

    document.addEventListener('dragstart', e => {
      if (e.target.tagName === 'IMG') e.preventDefault();
    });
  </script>
  @livewireScripts
</body>

</html>