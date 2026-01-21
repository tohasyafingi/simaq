<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIMAQ</title>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #e0f7f1 100%);
            position: relative;
        }

        .login-container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            background: #ffffff;
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

        .form-control:focus {
            border-color: #16a085;
            box-shadow: 0 0 0 0.2rem rgba(22, 160, 133, 0.25);
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

        .text-danger {
            font-size: 0.875rem;
        }

        .copyright {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            color: #333333;
            font-size: 0.9rem;
            z-index: 1;
            opacity: 0.6;
        }

        .copyright a {
            color: #333333;
            text-decoration: none;
        }

        .copyright a:hover {
            color: #555555;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <img src="{{ asset('assets/logo.webp') }}" alt="Logo Sekolah" class="logo">

            <h2>Reset Password</h2>
            <p class="text-muted mb-4">Masukkan password baru Anda.</p>

            <!-- Alert -->
            @if (session('status'))
            <div class="alert alert-success mb-3">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3 text-start">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="Email" />
                    @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 text-start">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required placeholder="Password Baru" />
                    @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3 text-start">
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" required placeholder="Konfirmasi Password" />
                    @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login w-100">Reset Password</button>
                </div>

                <div>
                    <a href="{{ route('login') }}" class="forgot-password">Back to Login</a>
                </div>

            </form>
        </div>
    </div>

    <div class="copyright">
        <strong>
            Copyright &copy; {{ date('Y') }}&nbsp;
            <a href="#">SIMAQ</a> |
        </strong>
        Support by <a href="#">@tohasyafingi</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>