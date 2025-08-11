<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    use ApiResponse;
    public function class_list()
    {
        $class_list = AddClass::all();

        return $this->successResponse($class_list,'Class List');
    }

    public function class_detail(string $id, string $type)
    {
        $common = Common::where('check',$type)->where('class_id',$id)->get();

        return $this->successResponse($common,'Class Detail');
    }
    public function index(string $type)
    {
        $common = Common::where('check',$type)
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return $this->successResponse($common,$type.' List');
    }

    public function show(string $type, string $id)
    {
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

        return $this->successResponse($common,$type.' List');
    }
}
