<?php
// Temporary one-time public script to create an admin user.
// USAGE:
//  1) Upload this file to your production `public/` directory.
//  2) Visit in browser or curl:
//     https://your-domain.tld/create_user_tmp.php?token=<TOKEN>&name=Admin&email=you%40example.com&password=Secret123&role=admin
//  3) After success this script will attempt to delete itself. If deletion fails, remove it manually immediately.
// IMPORTANT: This file is intentionally minimal; keep it temporary and delete after use.

// --- CONFIG: paste the token string provided by the maintainer here ---
$ONE_TIME_TOKEN = 'f4d8a9c3e2b17f6a9c4d3b2e1f0a9b8c7d6e5f4a3b2c1d0e9f8a7b6c5d4e3f2';

// Optional: restrict by remote IPs (leave empty to allow any IP with token)
$ALLOWED_IPS = []; // Example: ['111.222.333.444']

// Basic safety checks
if (!isset($_GET['token']) || $_GET['token'] !== $ONE_TIME_TOKEN) {
    http_response_code(403);
    echo "Forbidden: invalid token.";
    exit;
}

if (!empty($ALLOWED_IPS) && !in_array($_SERVER['REMOTE_ADDR'] ?? '', $ALLOWED_IPS, true)) {
    http_response_code(403);
    echo "Forbidden: your IP is not allowed.";
    exit;
}

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$name = trim($_GET['name'] ?? 'Admin');
$email = trim($_GET['email'] ?? '');
$password = $_GET['password'] ?? '';
$role = trim($_GET['role'] ?? 'admin');

if (!$email || !$password) {
    http_response_code(400);
    echo "Missing required parameters. Provide 'email' and 'password'.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Invalid email format.";
    exit;
}

try {
    if (User::where('email', $email)->exists()) {
        echo "User with email {$email} already exists.";
    } else {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'status' => 1,
            'email_verified_at' => now(),
        ]);

        echo "OK: created user id={$user->id}, email={$user->email}.\n";
        echo "This script will now attempt to delete itself. If deletion fails, remove create_user_tmp.php from public/ immediately.";
    }
} catch (\Exception $e) {
    http_response_code(500);
    echo "Error creating user: " . $e->getMessage();
    exit;
}

// Attempt to remove this file from server for safety
try {
    @unlink(__FILE__);
} catch (\Throwable $t) {
    // ignore
}

return;
