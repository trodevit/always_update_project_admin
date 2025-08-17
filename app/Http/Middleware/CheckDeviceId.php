<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDeviceId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        // Skip device check if feature flag is off
        if (!config('app.device_check_enabled')) {
            return $next($request);
        }

        // Get device ID from header or body
        $deviceId = $request->header('device-id') ?? $request->input('device_id');

        if (!$deviceId) {
            return response()->json([
                'status' => false,
                'message' => 'Device ID required'
            ], 400);
        }

        if ($user->device_id && $user->device_id !== $deviceId) {
            return response()->json([
                'status' => false,
                'message' => 'Access denied: Device not recognized.'
            ], 403);
        }

        return $next($request);
    }
}
