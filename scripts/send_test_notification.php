<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Notifications\PasswordChangedNotification;

$u = User::whereNotNull('email')->first();
if (! $u) {
    echo "No user with email found\n";
    exit(1);
}

try {
    $u->notify(new PasswordChangedNotification());
    echo "Notification sent (dispatched)\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
