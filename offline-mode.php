<?php
/**
 * Script untuk mengaktifkan/menonaktifkan offline mode
 * 
 * Usage:
 * php offline-mode.php on   - Aktifkan offline mode
 * php offline-mode.php off  - Nonaktifkan offline mode
 */

if ($argc < 2) {
    echo "Usage: php offline-mode.php [on|off]\n";
    exit(1);
}

$mode = strtolower($argv[1]);

if (!in_array($mode, ['on', 'off'])) {
    echo "Mode harus 'on' atau 'off'\n";
    exit(1);
}

$envFile = '.env';
$envContent = file_get_contents($envFile);

if ($mode === 'on') {
    // Aktifkan offline mode
    $envContent = preg_replace('/OFFLINE_MODE=false/', 'OFFLINE_MODE=true', $envContent);
    echo "✅ Offline mode DIAKTIFKAN\n";
    echo "📱 Web sekarang bisa jalan tanpa internet\n";
    echo "❌ Google OAuth dan Midtrans payment gateway dinonaktifkan\n";
} else {
    // Nonaktifkan offline mode
    $envContent = preg_replace('/OFFLINE_MODE=true/', 'OFFLINE_MODE=false', $envContent);
    echo "✅ Offline mode DINONAKTIFKAN\n";
    echo "🌐 Web sekarang membutuhkan internet untuk fitur lengkap\n";
    echo "✅ Google OAuth dan Midtrans payment gateway diaktifkan\n";
}

file_put_contents($envFile, $envContent);

echo "\n🔄 Silakan restart server Laravel untuk menerapkan perubahan:\n";
echo "   php artisan serve\n";