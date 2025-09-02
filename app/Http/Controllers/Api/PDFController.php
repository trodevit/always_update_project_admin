<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PDFCourse;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function classGroup($group)
    {
        $pdf = PDFCourse::where('class_name','SSC')
            ->where('types','pdf')
            ->where('group',$group)
            ->get();
        return $this->successResponse($pdf,'All PDF From SSC');
    }

    public function classID($id)
    {
        $pdf = PDFCourse::find($id);
        return $this->successResponse($pdf,'All PDF From SSC');
    }
}
