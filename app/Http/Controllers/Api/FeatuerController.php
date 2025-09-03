<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class FeatuerController extends Controller
{
    public function addDeviceId(Request $request)
    {
        $data = $request->validate([
            'device_id' => 'required',
            'device_name'=>'required'
        ]);

        $user = User::where('device_id', $data['device_id'])
            ->where('device_name', $data['device_name'])
            ->first();

        if ($user) {
            $user->login_count = $user->login_count + 1;
            $user->save();
        } else {
            $user = User::create([
                'device_id' => $data['device_id'],
                'device_name' => $data['device_name'],
                'login_count' => 1,
            ]);
        }

        return $this->successResponse($user,'Device ID Added Successfully');
    }

    public function getnotification()
    {
        $notifications = DatabaseNotification::all()->map(function($n) {
            return [
                'title' => $n->data['title'] ?? null,
                'body' => $n->data['body'] ?? null,
                'created_at' => $n->created_at->toDateTimeString(),
            ];
        });

        return response()->json($notifications);
    }


}
