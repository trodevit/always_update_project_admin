<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $envEmail = config('admin.email');
        $envPasswordHash = config('admin.password');

        if ($request->email !== $envEmail) {
            return redirect()->back()->withErrors(['Please enter valid email'])->withInput();
        }

        if (!Hash::check($request->password, $envPasswordHash)) {
            return redirect()->back()->withErrors(['Wrong Password'])->withInput();
        }

        Session::put('admin', true);

        return redirect()->route('dashboard')->with('success', 'Welcome back');
    }

    public function logout(){
        Session::forget('admin');
        return redirect()->route('loginPage')->with('success', 'You have been logged out');
    }
}
