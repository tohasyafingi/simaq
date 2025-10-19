<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MATAQ WSB</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    {{-- <link href="{{ asset('portal/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
    <link href="{{ asset('portal/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('portal/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('portal/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('portal/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('portal/assets/css/main.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Landify
  * Template URL: https://bootstrapmade.com/landify-bootstrap-landing-page-template/
  * Updated: Aug 04 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    @livewireStyles
</head>

<body class="index-page">

    <!-- ***** Header Area Start ***** -->
    @include('components.layouts.portal.header')
    <!-- ***** Header Area End ***** -->
    <main class="main">
        {{ $slot }}
    </main>

    @include('components.layouts.portal.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
    {{-- <script data-navigate-once src="{{ asset('portal/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
    <script data-navigate-once src="{{ asset('portal/assets/vendor/php-email-form/validate.js')}}"></script>
    <script data-navigate-once src="{{ asset('portal/assets/vendor/aos/aos.js')}}"></script>
    <script data-navigate-once src="{{ asset('portal/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script data-navigate-once src="{{ asset('portal/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script data-navigate-once src="{{ asset('portal/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script data-navigate-once src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('portal/assets/js/main.js')}}"></script>
    @livewireScripts
</body>

</html>