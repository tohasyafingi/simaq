<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $title = 'Verify Email'; @endphp
    @include('components.layouts.meta')
    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16.png')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon-192.png')}}" />
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/icon-512.png')}}" />
    <meta name="theme-color" content="#ffffff">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #e0f7f1 100%);
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .login-card h2 {
            color: #1abc9c;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .btn-login {
            background-color: #1abc9c;
            border: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }

        .btn-login:hover {
            background-color: #16a085;
            color: white;
        }

        .forgot-password {
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .login-card .logo {
            width: 100px;
            margin-bottom: 1rem;
        }

        .alert {
            font-size: 0.9rem;
        }

        .copyright {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: #333333;
            font-size: 0.9rem;
            opacity: 0.6;
        }

        .copyright a {
            color: #333333;
            text-decoration: none;
        }

        .copyright a:hover {
            color: #555555;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <img src="{{ asset('assets/logo.webp') }}" alt="Logo Sekolah" class="logo">

            <h2>Verify Your Email</h2>
            <p class="text-muted mb-4">
                Thanks for signing up! Before getting started, please verify your email by clicking the link we sent.
                If you didn’t receive the email, we can send you another.
            </p>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-3">
                A new verification link has been sent to your email address.
            </div>
            @endif

            <div class="d-grid gap-2 mb-3">
                <!-- Resend Verification -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-login w-100">Resend Verification Email</button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100">Log Out</button>
                </form>
            </div>

            <div>
                <a href="{{ route('login') }}" class="forgot-password">Back to Login</a>
            </div>
        </div>
    </div>

    <div class="copyright small">
        Copyright &copy; {{ date('Y') }}&nbsp; All Rights Reserved by
        <strong>
            <a href="{{ route('beranda') }}" class="text-decoration-none">MATAQ WONOSOBO </a>
        </strong>
        {{-- | Support by <a href="#" class="text-decoration-none"> @tohasyafingi</a> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>