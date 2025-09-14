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
                'levels'   => 'nullable|array', // allow multiple checkbox values
                'levels.*' => 'in:SSC,HSC,Honors',
            ]);

            $updateData = [
                'email' => $data['email'],
                'plain_password' => $data['password'],
                'password' => Hash::make($data['password']),
                'levels'         => !empty($data['levels']) ? json_encode($data['levels']) : json_encode([]),
            ];

            $user = User::findOrFail($device_id);


          $user->update($updateData);



            return redirect()->back()->with('success',
                'For ' . $user->device_id . ' successfully updated email and password.<br>' .
                'Email: ' . $user->email . '<br>' .
                'Password: ' . $user->plain_password . '<br>' .
                'Levels: ' . implode(', ', json_decode($user->levels, true))
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

//        $user = User::where('email', $request->email)->first();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user
        ]);
    }
}
