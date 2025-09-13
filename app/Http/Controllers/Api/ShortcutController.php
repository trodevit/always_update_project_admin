<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllPDF;
use App\Models\HonorsQuestion;
use App\Models\PDFCourse;
use App\Models\Subject;
use Illuminate\Http\Request;

class ShortcutController extends Controller
{
    public function index($group)
    {
        $shortcut = PDFCourse::where('group', $group)->where('class_name','SSC')->where('types','technique')->get();

        return $this->successResponse($shortcut,'Shortcut List');
    }

    public function videoindex($group)
    {
        $shortcut = PDFCourse::where('group', $group)->where('class_name','SSC')->where('types','video_technique')->get();

        return $this->successResponse($shortcut,'Shortcut List');
    }

    public function allPDF($group, $question_types, $subject_id)
    {
        $shortcut = AllPDF::where('group', $group)->where('class_name','SSC')->where('types','all_pdf')
            ->where('question_types',$question_types)
            ->where('subjects',$subject_id)
            ->get();

        return $this->successResponse($shortcut,'All PDF List');
    }

    public function videoallPDF($group, $question_types, $subject_id)
    {
        $shortcut = AllPDF::where('group', $group)->where('class_name','SSC')->where('types','video_all_pdf')
            ->where('question_types',$question_types)
            ->where('subjects',$subject_id)
            ->get();

        return $this->successResponse($shortcut,'All PDF List');
    }

    public function subjects()
    {
        $subjects = Subject::all();

        return $this->successResponse($subjects,'Subject List');
    }

    public function videoCourse($group, $subject_id)
    {

        $shortcut = AllPDF::where('group',$group)->where('subjects',$subject_id)->get();
//        $shortcut = AllPDF::where('group', $group)->where('class_name','SSC')->where('types','video')
//            ->where('subjects',$subject_id)
//            ->get();

        dd($shortcut);
        return $this->successResponse($shortcut,'All PDF List');
    }

    public function mcqQuestion($group, $subject_id)
    {
        $shortcut = HonorsQuestion::where('group', $group)->where('class_name','honors')->where('question','question_pdf')
            ->where('subject',$subject_id)
            ->get();

        return $this->successResponse($shortcut,'All PDF List');
    }
}
