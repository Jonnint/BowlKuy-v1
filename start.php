<?php
/**
 * Simple startup script - langsung start server dengan auto-detection
 */

echo "🍜 Starting BowlKuy with Auto-Detection...\n\n";

// Quick check
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Helpers\InternetDetector;

$hasInternet = InternetDetector::hasInternet();
echo "📡 Connection: " . ($hasInternet ? "🌐 ONLINE" : "📱 OFFLINE") . " (Auto-detected)\n";
echo "🎯 Mode: " . ($hasInternet ? "Google OAuth + Midtrans" : "Email Login + Manual Transfer") . "\n\n";

echo "🚀 Starting Laravel server...\n";
echo "📱 Admin panel will auto-switch based on your internet connection\n";
echo "🔄 No manual commands needed!\n\n";

// Start server
passthru('php artisan serve');