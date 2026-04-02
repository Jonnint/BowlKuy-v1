<?php

namespace App\Helpers;

class OfflineHelper
{
    /**
     * Check apakah dalam offline mode
     * Sekarang auto-detect berdasarkan koneksi internet
     */
    public static function isOfflineMode(): bool
    {
        // Jika OFFLINE_MODE di-set manual di .env, gunakan itu
        $manualMode = env('OFFLINE_MODE', null);
        if ($manualMode !== null) {
            return (bool) $manualMode;
        }

        // Auto-detect berdasarkan koneksi internet
        return !InternetDetector::hasInternet();
    }

    public static function isOnlineMode(): bool
    {
        return !self::isOfflineMode();
    }

    public static function canUseExternalServices(): bool
    {
        return self::isOnlineMode();
    }

    /**
     * Get current mode string
     */
    public static function getCurrentMode(): string
    {
        return self::isOfflineMode() ? 'offline' : 'online';
    }

    /**
     * Check if internet is available (real-time)
     */
    public static function hasInternet(): bool
    {
        return InternetDetector::hasInternet();
    }
}