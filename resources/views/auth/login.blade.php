<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Landify Bootstrap Template</title>
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
        <!-- Login Section -->
        <section id="login" class="contact section light-background">
            <div style="padding-top: 30px">
                <!-- Section Title -->
                <div class="container section-title text-center">
                    <span class="description-title">Login</span>
                    <h2>Welcome Back</h2>
                    <p>Silakan masuk untuk melanjutkan ke dashboard</p>
                </div>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5 justify-content-center">
                    
                    <div class="col-lg-6">
                        <div class="contact-form card shadow-sm" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body p-4 p-lg-5">

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login') }}" data-aos="fade-up"
                                    data-aos-delay="600">
                                    @csrf

                                    <div class="row gy-4">

                                        <!-- Email -->
                                        <div class="col-12">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email Address" value="{{ old('email') }}" required
                                                autofocus>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" required>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="col-12 d-flex align-items-center">
                                            <input id="remember_me" type="checkbox" name="remember"
                                                class="me-2">
                                            <label for="remember_me" class="mb-0">Remember me</label>
                                        </div>

                                        <!-- Button -->
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-submit w-100">Login</button>
                                        </div>

                                        <!-- Register & Forgot Password -->
                                        <div class="col-12 text-center mt-3">
                                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                                        </div>

                                    </div>
                                </form>
                                <!-- End Login Form -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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

    <!-- Main JS File -->
    <script src="{{ asset('portal/assets/js/main.js')}}"></script>
    @livewireScripts
</body>

</html>