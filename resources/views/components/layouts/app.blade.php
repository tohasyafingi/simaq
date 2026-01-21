<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIMAQ | {{$title}} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="" />
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

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

    @include('components.layouts.style')
    @livewireStyles
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">
        @include('components.layouts.navbar')
        @if(Auth::user()->role == 'admin')
        @include('components.layouts.sidebar')
        @elseif(Auth::user()->role == 'guru')
        @include('components.layouts.sidebar-guru')
        @elseif(Auth::user()->role == 'siswa')
        @include('components.layouts.sidebar-siswa')
        @endif
        {{-- @include('layouts.sidebar') --}}

        <main class="app-main">
            <x-alert />
            {{ $slot }}
        </main>
        @include('components.layouts.footer')
    </div>
    @include('components.layouts.script')
    @livewireScripts
</body>

</html>