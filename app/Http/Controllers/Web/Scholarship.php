<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;

class Scholarship extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $common = Common::where('check','scholarship')
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return view('scholarship.index', ['common' => $common]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = AddClass::all();
        return view('scholarship.create',['class'=>$class]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
