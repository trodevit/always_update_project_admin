<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

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

        $user = User::firstOrCreate(
            [
                'device_id' => $data['device_id'],
                'device_name' => $data['device_name']
            ],
        );

        return $this->successResponse($user,'Device ID Added Successfully');
    }
}
