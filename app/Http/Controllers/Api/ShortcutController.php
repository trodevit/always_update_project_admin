<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllPDF;
use App\Models\PDFCourse;
use Illuminate\Http\Request;

class ShortcutController extends Controller
{
    public function index($group)
    {
        $shortcut = PDFCourse::where('group', $group)->where('class_name','SSC')->where('types','technique')->get();

        return $this->successResponse($shortcut,'Shortcut List');
    }

    public function allPDF($group, $question_types)
    {
        $shortcut = AllPDF::where('group', $group)->where('class_name','SSC')->where('types','all_pdf')
            ->where('question_types',$question_types)->get();

        return $this->successResponse($shortcut,'All PDF List');
    }
}
