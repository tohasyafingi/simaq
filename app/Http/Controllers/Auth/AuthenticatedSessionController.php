<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected $roleRoutes = [
        'admin' => 'superadmin.admin.dashboard',
        'guru' => 'superadmin.guru.dashboard',
        'siswa' => 'superadmin.siswa.dashboard',
        'karyawan' => 'karyawan.dashboard',
        'bendahara' => 'bendahara.dashboard',
        'alumni' => 'alumni.dashboard',
    ];
    /**
     * Display the login view.
     */
    // public function create(): View
    // {
    //     return view('auth.login');
    // }

    public function create(): View
    {
        // Generate angka acak dari 0 sampai 9
        $num1 = rand(0, 9);
        $num2 = rand(0, 9);

        // Pilih operator + atau x
        $operators = ['+', 'x'];
        $operator = $operators[array_rand($operators)];

        // Hitung jawaban
        $answer = $operator === '+' ? $num1 + $num2 : $num1 * $num2;

        // Simpan jawaban di session
        session(['captcha_answer' => $answer]);

        // Kirim ke view
        return view('auth.login', compact('num1', 'num2', 'operator'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi tambahan untuk captcha
        $request->validate([
            'captcha' => 'required|integer',
        ]);

        if ($request->input('captcha') != session('captcha_answer')) {
            return redirect()->route('login')
                ->with('error', 'Jawaban salah. Silakan coba lagi.');
        }

        // Autentikasi user
        $request->authenticate();

        if (!Auth::user()->status) {
            Auth::logout();

            return redirect()->route('login')
                ->with('error', 'Akun anda tidak aktif. Silakan hubungi admin.');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $route = $this->roleRoutes[$user->role] ?? null;

        if ($route && Route::has($route)) {
            return redirect()->route($route);
        }

        Auth::logout();

        return redirect()->route('login')
            ->with('error', 'Akun tidak dikenali atau belum punya akses.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
