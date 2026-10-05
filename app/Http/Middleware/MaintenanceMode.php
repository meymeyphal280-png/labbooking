<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceMode = Setting::where(
            'setting_key',
            'maintenance_mode'
        )->value('setting_value');

        // Maintenance mode is OFF
        if ($maintenanceMode !== '1') {
            return $next($request);
        }

        // Admin can still access the system
        if ($request->user() && $request->user()->role === 'Admin') {
            return $next($request);
        }

        // Everyone else sees maintenance page
        return response()->view('maintenance');
    }
}