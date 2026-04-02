<?php

namespace App\Helpers;

class InternetDetector
{
    private static $cache = null;
    private static $lastCheck = 0;
    private static $cacheTimeout = 30; // Cache selama 30 detik

    /**
     * Check apakah ada koneksi internet
     */
    public static function hasInternet(): bool
    {
        // Gunakan cache untuk menghindari check berulang-ulang
        if (self::$cache !== null && (time() - self::$lastCheck) < self::$cacheTimeout) {
            return self::$cache;
        }

        $hasInternet = self::checkInternetConnection();
        
        // Update cache
        self::$cache = $hasInternet;
        self::$lastCheck = time();
        
        return $hasInternet;
    }

    /**
     * Check koneksi internet dengan multiple methods
     */
    private static function checkInternetConnection(): bool
    {
        // Method 1: Ping Google DNS (fastest)
        if (self::pingHost('8.8.8.8', 53, 2)) {
            return true;
        }

        // Method 2: Check HTTP connection
        if (self::checkHttpConnection()) {
            return true;
        }

        // Method 3: Check dengan fsockopen
        if (self::checkSocketConnection()) {
            return true;
        }

        return false;
    }

    /**
     * Ping host dengan timeout
     */
    private static function pingHost($host, $port, $timeout): bool
    {
        try {
            $socket = @fsockopen($host, $port, $errno, $errstr, $timeout);
            if ($socket) {
                fclose($socket);
                return true;
            }
        } catch (Exception $e) {
            // Ignore error
        }
        return false;
    }

    /**
     * Check HTTP connection
     */
    private static function checkHttpConnection(): bool
    {
        $urls = [
            'http://www.google.com',
            'http://www.cloudflare.com',
            'http://1.1.1.1'
        ];

        foreach ($urls as $url) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 3,
                    'method' => 'HEAD'
                ]
            ]);

            try {
                $result = @file_get_contents($url, false, $context);
                if ($result !== false || !empty($http_response_header)) {
                    return true;
                }
            } catch (Exception $e) {
                continue;
            }
        }

        return false;
    }

    /**
     * Check socket connection
     */
    private static function checkSocketConnection(): bool
    {
        $hosts = [
            ['google.com', 80],
            ['cloudflare.com', 80],
            ['1.1.1.1', 80]
        ];

        foreach ($hosts as [$host, $port]) {
            if (self::pingHost($host, $port, 2)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Force refresh cache
     */
    public static function refreshCache(): bool
    {
        self::$cache = null;
        self::$lastCheck = 0;
        return self::hasInternet();
    }

    /**
     * Get current mode based on internet connection
     */
    public static function getCurrentMode(): string
    {
        return self::hasInternet() ? 'online' : 'offline';
    }

    /**
     * Check if we should use online features
     */
    public static function canUseOnlineFeatures(): bool
    {
        return self::hasInternet();
    }
}