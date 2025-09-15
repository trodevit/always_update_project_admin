<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PDFCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PDFController extends Controller
{

    public function classGroup($group)
    {

        $pdf = PDFCourse::where('class_name', 'SSC')
            ->where('types', 'pdf')
            ->where('group', $group)
            ->get();

        return $this->successResponse($pdf, 'All PDF From SSC');

    }

    public function videoclassGroup($group)
    {
        $pdf = PDFCourse::where('class_name','SSC')
            ->where('types','video_pdf')
            ->where('group',$group)
            ->get();
        return $this->successResponse($pdf,'All PDF From SSC');
    }

    public function honorsGroup($group)
    {
        $pdf = PDFCourse::where('class_name','honors')
            ->where('types','grppdf')
            ->where('group',$group)
            ->get();
        return $this->successResponse($pdf,'All PDF From SSC');
    }

    public function classID($id)
    {
        $pdf = PDFCourse::find($id);
        return $this->successResponse($pdf,'All PDF From SSC');
    }

    public function hscpdf($group)
    {
        $pdf = PDFCourse::where('class_name', 'hsc')
            ->where('types', 'pdf')
            ->where('group', $group)
            ->get();

        return $this->successResponse($pdf, 'All PDF From SSC');
    }
}
