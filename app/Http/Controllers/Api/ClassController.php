<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function rubayet($class_name, $check)
    {
//        dd($class_name, $check);
        $suggestion = Suggestion::where('class_name',$class_name)->where('types',$check)->get();

        return $this->successResponse($suggestion, ucfirst($check) . ' successfully retrive from ' . strtoupper($class_name));
    }

    public function show($id){
        $suggestion = Suggestion::find($id);

        return $this->successResponse($suggestion, 'Retrive successfully');
    }
}
