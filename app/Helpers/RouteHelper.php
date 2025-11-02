<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (!function_exists('routeRoleBased')) {
    /**
     * Generate route berdasarkan role dengan auto-detect context.
     *
     * @param  string  $name     Nama route tanpa prefix
     * @param  array   $params   Parameter tambahan untuk route
     * @return string
     */
    function routeRoleBased(string $name, array $params = []): string
    {
        $user = Auth::user();

        if (!$user) {
            return '#';
        }

        $role = $user->role;
        $context = null;

        // Auto-detect context berdasarkan parameter
        if (isset($params['guruPelajaranId']) || isset($params['gurumodulId'])) {
            $context = 'guru';
        } elseif (isset($params['siswaId']) || isset($params['siswamodulId'])) {
            $context = 'siswa';
        }

        // Tentukan prefix sesuai role dan context
        $prefix = match ($role) {
            'guru' => 'superadmin.guru.',
            'siswa' => 'superadmin.siswa.',
            'admin' => match ($context) {
                'guru' => 'superadmin.admin.guru-pengajar.',
                'siswa' => 'superadmin.admin.siswa-rombel.',
                default => 'superadmin.admin.',
            },
            default => '#',
        };

        if ($prefix === '#') {
            return '#';
        }

        $fullRoute = $prefix . $name;

        if (!Route::has($fullRoute)) {
            return '#';
        }

        return route($fullRoute, $params);
    }
}
