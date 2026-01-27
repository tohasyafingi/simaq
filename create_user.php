<?php
// One-time script to create a user in production (shared hosting).
// Usage (after upload):
//   https://your-site.tld/create_user.php?token=LONG_TOKEN&name=Nama&email=you%40example.com&password=Secret123&role=admin
// IMPORTANT: Replace the value of $ONE_TIME_TOKEN below with a long random secret BEFORE uploading.
// After successful use, DELETE this file immediately.

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$ONE_TIME_TOKEN = 'REPLACE_WITH_A_LONG_RANDOM_TOKEN'; // <-- REPLACE THIS

if (!isset($_GET['token']) || $_GET['token'] !== $ONE_TIME_TOKEN) {
    http_response_code(403);
    echo "Forbidden: invalid token.";
    exit;
}

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

if (User::where('email', $email)->exists()) {
    echo "User with email {$email} already exists.";
    exit;
}

try {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'role' => $role,
        'status' => 1,
        'email_verified_at' => now(),
    ]);

    echo "OK: created user id={$user->id}, email={$user->email}.\n";
    echo "Please DELETE this file now to avoid security risk.";
} catch (\Exception $e) {
    http_response_code(500);
    echo "Error creating user: " . $e->getMessage();
}
