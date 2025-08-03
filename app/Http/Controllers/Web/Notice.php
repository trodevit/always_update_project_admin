<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;

class Notice extends Controller
{
    public function index()
    {
        $common = Common::where('check','notice')
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return view('notice.index', ['common' => $common]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = AddClass::all();
        return view('notice.create',['class' => $class]);
    }
}
