<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
        dd($class_name);
        $courses = Course::where('class_name', $class_name)->get();

        return $this->successResponse($courses, $class_name.' List');
    }
}
