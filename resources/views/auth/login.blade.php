<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - SIMAQ</title>

    <!-- Disable cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Custom CSS -->
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
            max-width: 400px;
            text-align: center;
        }

        .login-card h2 {
            color: #1abc9c;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .login-card .form-control:focus {
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
        }

        .login-card .logo {
            width: 100px;
            margin-bottom: 1rem;
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
                margin: 0 1rem;
            }
        }
    </style>
    @livewireStyles
</head>

<body>

    <div class="login-container">

        <div class="login-card">
            <!-- Logo -->
            <img src="{{ asset('assets/logo.webp') }}" alt="Logo Sekolah" class="logo">

            <h2>Selamat Datang</h2>
            <p class="text-muted mb-4">Sistem Informasi Akademik MA Takhassus Al-Qur'an Wonosobo</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-check mb-3 text-start">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login w-100">Login</button>
                </div>

                <div>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>
                </div>
                <div>
                    <a href="{{ route('beranda') }}" class="forgot-password">Halaman Utama</a>
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
    @livewireScripts
</body>

</html>