<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MATAQ WSB | {{ $title ?? '' }}</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon.png')}}" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon.png')}}" />
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon.png')}}" />
  <meta name="theme-color" content="#ffffff">

  {{-- Bootstrap & Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  {{-- Main CSS --}}
  <link rel="stylesheet" href="{{ asset('code/assets/css/main.css') }}">

  {{-- Livewire Styles --}}
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