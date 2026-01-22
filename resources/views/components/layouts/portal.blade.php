<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  @include('components.layouts.meta')

  {{-- Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon.png')}}" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon.png')}}" />
  <meta name="theme-color" content="#ffffff">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


  <link rel="stylesheet" href="{{ asset('code/assets/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

  @livewireStyles

</head>

<body>

  @include('components.layouts.portal.header')

  {{ $slot }}

  @include('components.layouts.portal.footer')

  <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script data-navigate-once src="{{ asset('code/assets/js/main.js') }}"></script>
  @livewireScripts
</body>

</html>