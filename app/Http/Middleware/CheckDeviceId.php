<?php

namespace App\Http\Middleware;

use App\Models\User;
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
//        dd($request->all());
        $email = $request->query('email');
        $deviceId = $request->input('device_id');
        $user = User::where('email',$email)->first();



        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        if (!config('app.device_check_enabled')) {
            return $next($request);
        }

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
