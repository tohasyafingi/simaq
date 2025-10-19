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

    @include('components.layouts.style')
    @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="sidebar-expand-lg fixed-header sidebar-mini bg-body-tertiary">
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