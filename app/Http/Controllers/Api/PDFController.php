<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PDFCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{

    public function classGroup($group, Request $request)
    {
//        $user = User::where('email',$request->query('email'))->first();
//        Auth::login($user);
//
//        $this->authorize('accessSSC',auth()->user());

        $pdf = PDFCourse::where('class_name','SSC')
            ->where('types','pdf')
            ->where('group',$group)
            ->get();
        return $this->successResponse($pdf,'All PDF From SSC');
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
}
