<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $envEmail = env('ADMIN_EMAIL');
        $envPasswordHash = env('ADMIN_PASSWORD');

        if ($request->email !== $envEmail) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (!Hash::check($request->password, $envPasswordHash)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return redirect()->route('dashboard');
    }
}
