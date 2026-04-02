<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\OfflineHelper;
use Symfony\Component\HttpFoundation\Response;

class AutoDetectMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set mode di session untuk digunakan di views
        $currentMode = OfflineHelper::getCurrentMode();
        session(['app_mode' => $currentMode]);
        
        // Set global variable untuk views
        view()->share('isOfflineMode', OfflineHelper::isOfflineMode());
        view()->share('isOnlineMode', OfflineHelper::isOnlineMode());
        view()->share('hasInternet', OfflineHelper::hasInternet());
        
        return $next($request);
    }
}