<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllPDF;
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

    public function allPDF($group, $question_types,$subject_id)
    {
        $shortcut = AllPDF::where('group', $group)->where('class_name','SSC')->where('types','all_pdf')
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
}
