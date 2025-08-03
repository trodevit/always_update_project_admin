<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;

class Result extends Controller
{
    public function index()
    {
        $common = Common::where('check','result')
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return view('result.index', ['common' => $common]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = AddClass::all();
        return view('result.create',['class' => $class]);
    }
}
