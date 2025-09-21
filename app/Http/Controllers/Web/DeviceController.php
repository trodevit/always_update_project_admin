<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class DeviceController extends Controller
{
    public function device_id()
    {
        $device = User::all();

        return view('devices.index', ['device' => $device]);
    }

    public function deviceList(Request $request)
    {
        $search = $request->input('search');

        $device = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('device_id', 'like', "%{$search}%")
                    ->orWhere('device_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        $totalResults = $device->count();
        return view('devices.index', ['device' => $device,'totalResults' => $totalResults,'search' => $search]);
    }


    public function devicesUpdate(Request $request, string $device_id)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'ssc'     => 'nullable|boolean',
                'hsc'     => 'nullable|boolean',
                'honors'  => 'nullable|boolean',
            ]);

            $updateData = [
                'email' => $data['email'],
                'plain_password' => $data['password'],
                'password' => Hash::make($data['password']),
                'ssc'            => $data['ssc'] ?? 0,
                'hsc'            => $data['hsc'] ?? 0,
                'honors'         => $data['honors'] ?? 0,
            ];

            $user = User::findOrFail($device_id);


          $user->update($updateData);
            $selectedLevels = [];
            if ($user->ssc) $selectedLevels[] = 'SSC';
            if ($user->hsc) $selectedLevels[] = 'HSC';
            if ($user->honors) $selectedLevels[] = 'Honors';


            return redirect()->back()->with('success',
                'For ' . $user->device_id . ' successfully updated email and password.<br>' .
                'Email: ' . $user->email . '<br>' .
                'Password: ' . $user->plain_password . '<br>' .
                'Levels: ' . implode(', ', $selectedLevels)
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

        // Attempt to log in the user
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
            'user' => $user,
        ]);
    }

}
