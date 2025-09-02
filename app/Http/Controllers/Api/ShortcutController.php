<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PDFCourse;
use Illuminate\Http\Request;

class ShortcutController extends Controller
{
    public function index($group)
    {
        $shortcut = PDFCourse::where('group', $group)->where('class_name','SSC')->where('types','technique')->get();

        return $this->successResponse($shortcut,'Shortcut List');
    }
}
