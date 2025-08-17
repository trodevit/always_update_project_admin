<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class CourseAPIController extends Controller
{
    public function allCourses(string $check)
    {
//        dd($check);
        $courses = Course::where('check', $check)->get();

        return $this->successResponse($courses,$check.' List');
    }

    public function singleCourse(string $course_id){
//        dd($course_id);
        $courses = Course::findOrFail($course_id);

        return $this->successResponse($courses,'All List');
    }

    public function classCourses(string $class_name)
    {
//        dd($class_name);
        $courses = Course::where('class_name', $class_name)->get();

        return $this->successResponse($courses, $class_name.' List');
    }

    public function classWiseCourses(string $class_name, string $check)
    {
        $courses = Course::where('class_name', $class_name)->where('check',$check)->get();

        return $this->successResponse($courses, $class_name.' List of '.$check.' Courses');
    }

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
            // Create new device with login_count = 1
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

    public function delete(string $id)
    {
        $device = User::findOrFail($id);

        $device->delete();

        return redirect()->back()->with('success','Delete Successfully');
    }
}
