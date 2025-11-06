<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIMAQ | {{$title}} </title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="" />
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon.png')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon.png')}}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon.png')}}" />
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon.png')}}" />
    <meta name="theme-color" content="#ffffff">

    @include('components.layouts.style')
    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('components.layouts.navbar')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @if(Auth::user()->role == 'admin')
            @include('components.layouts.sidebar')
        @elseif(Auth::user()->role == 'guru')
            @include('components.layouts.sidebar-guru')
        @elseif(Auth::user()->role == 'siswa')
            @include('components.layouts.sidebar-siswa')
        @endif
        {{-- @include('layouts.sidebar') --}}
        <!--end::Sidebar-->
        <main class="app-main">
            <x-alert />
            <!--begin::App Main-->
            {{ $slot }}
            <!--end::App Main-->
        </main>
        <!--begin::Footer-->
        @include('components.layouts.footer')
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    @include('components.layouts.script')
    @livewireScripts
</body>
<!--end::Body-->

</html>