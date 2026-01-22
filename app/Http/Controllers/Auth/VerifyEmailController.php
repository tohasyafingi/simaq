<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->redirectToRoleDashboard($user->role);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectToRoleDashboard($user->role);
    }

    protected function redirectToRoleDashboard(?string $role): RedirectResponse
    {
        $roleRoutes = [
            'admin' => 'superadmin.admin.dashboard',
            'guru' => 'superadmin.guru.dashboard',
            'siswa' => 'superadmin.siswa.dashboard',
            'karyawan' => 'karyawan.dashboard',
            'bendahara' => 'bendahara.dashboard',
            'alumni' => 'alumni.dashboard',
        ];

        $route = $roleRoutes[$role] ?? null;

        if ($route && Route::has($route)) {
            return redirect()->intended(route($route).'?verified=1');
        }

        return redirect()->intended(route('beranda').'?verified=1');
    }
}
