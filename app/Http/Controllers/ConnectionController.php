<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\InternetDetector;
use App\Helpers\OfflineHelper;

class ConnectionController extends Controller
{
    /**
     * Check current connection status
     */
    public function status()
    {
        $hasInternet = InternetDetector::hasInternet();
        $mode = OfflineHelper::getCurrentMode();
        
        return response()->json([
            'hasInternet' => $hasInternet,
            'mode' => $mode,
            'canUseOnlineFeatures' => OfflineHelper::canUseExternalServices(),
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Force refresh connection check
     */
    public function refresh()
    {
        $hasInternet = InternetDetector::refreshCache();
        $mode = OfflineHelper::getCurrentMode();
        
        return response()->json([
            'hasInternet' => $hasInternet,
            'mode' => $mode,
            'canUseOnlineFeatures' => OfflineHelper::canUseExternalServices(),
            'timestamp' => now()->toISOString(),
            'refreshed' => true
        ]);
    }
}