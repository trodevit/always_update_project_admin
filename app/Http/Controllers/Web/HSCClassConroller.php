<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HSCClass;
use Illuminate\Http\Request;

class HSCClassConroller extends Controller
{
    public function index()
    {

    }

    public function create(){
        $class = HSCClass::all();
        return view('hsc.class',['subjects'=>$class]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'class_name'=>'required'
        ]);

        HSCClass::create($data);

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'class_name'=>'required'
        ]);

        $class = HSCClass::find($id);

        $class->update($data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $class = HSCClass::find($id);

        $class->delete();

        return redirect()->back();
    }
}
