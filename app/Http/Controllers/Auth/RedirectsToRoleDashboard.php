<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

trait RedirectsToRoleDashboard
{
    protected function redirectToRoleDashboard(?string $role, bool $appendVerified = false): RedirectResponse
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
            $url = route($route);
            if ($appendVerified) {
                $url .= (str_contains($url, '?') ? '&' : '?') . 'verified=1';
            }
            return redirect()->intended($url);
        }

        $fallback = route('beranda');
        if ($appendVerified) {
            $fallback .= '?verified=1';
        }

        return redirect()->intended($fallback);
    }
}
