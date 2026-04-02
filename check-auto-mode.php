<?php
/**
 * Simple check untuk memastikan auto-detection berjalan
 * Tanpa output verbose, hanya status
 */

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Helpers\InternetDetector;
use App\Helpers\OfflineHelper;

$hasInternet = InternetDetector::hasInternet();
$mode = OfflineHelper::getCurrentMode();

echo "Status: " . ($hasInternet ? "🌐 ONLINE" : "📱 OFFLINE") . " (Auto-detected)\n";

if ($hasInternet) {
    echo "✅ Google OAuth: Available\n";
    echo "✅ Midtrans: Available\n";
} else {
    echo "📱 Google OAuth: Disabled (Email/Password login only)\n";
    echo "📱 Midtrans: Disabled (Manual transfer only)\n";
}

echo "\n🚀 Server ready: php artisan serve\n";