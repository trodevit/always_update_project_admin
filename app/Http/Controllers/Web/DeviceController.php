<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeviceController extends Controller
{
    public function device_id()
    {
        $device = User::all();

        return view('devices.index', ['device' => $device]);
    }

    public function devicesUpdate(Request $request, string $device_id)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $updateData = [
                'email' => $data['email'],
                'plain_password' => $data['password'],
                'password' => Hash::make($data['password']),
            ];

            $user = User::findOrFail($device_id);


          $user->update($updateData);



            return redirect()->back()->with('success',
                'For ' . $user->device_id . ' successfully updated email and password.<br>' .
                'Email: ' . $user->email . '<br>' .
                'Password: ' . $user->plain_password
            );
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_id' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

//        Auth::login($user);

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user
        ]);
    }
}
