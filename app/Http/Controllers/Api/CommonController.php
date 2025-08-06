<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function class_list()
    {
        $class_list = AddClass::all();

        return response()->json([
            'status' => true,
            'message' => 'Class',
            'data' => $class_list
        ],200);
    }

    public function class_detail(string $id, string $type)
    {
        $common = Common::where('check',$type)->where('class_id',$id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Class',
            'data' => $common
        ]);
    }
    public function index(string $type)
    {
        $common = Common::where('check',$type)
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return response()->json([
            'status' => true,
            'message' => $type .' '. 'list',
            'data' => $common
        ],200);
    }

    public function show(string $type, string $id)
    {
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

        return response()->json([
            'status' => true,
            'message' => $type .' '. 'list',
            'data' => $common
        ],200);
    }
}
