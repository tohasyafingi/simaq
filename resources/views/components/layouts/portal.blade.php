<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - High School Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('portal/main.css')}}" rel="stylesheet">

    @livewireStyles
</head>

<body>

    @include('components.layouts.portal.header')
    <!-- ***** Header Area End ***** -->

    {{ $slot }}

    @include('components.layouts.portal.footer')

    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>

</html>