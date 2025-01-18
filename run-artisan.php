<?php
use Illuminate\Support\Facades\Artisan;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Run migrations
Artisan::call('migrate', ['--force' => true]);

// Optionally, run seeders
// Artisan::call('db:seed', ['--force' => true]);

echo Artisan::output();
?>
