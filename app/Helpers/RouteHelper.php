<?php

if (!function_exists('routeGuruOrAdmin')) {
    function routeGuruOrAdmin($name, $params = [])
    {
        $user = auth()->user();

        if (!$user) {
            return '#';
        }

        $prefix = $user->role === 'guru'
            ? 'superadmin.guru.'
            : 'superadmin.admin.guru-pengajar.';

        $fullRoute = $prefix . $name;

        if (!\Illuminate\Support\Facades\Route::has($fullRoute)) {
            // fallback supaya tidak error
            return '#';
        }

        return route($fullRoute, $params);
    }
}
