<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\VideoCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pdf = VideoCourse::where('class_name','SSC')->where('types','video')
            ->join('subjects','subjects.id','=','video_courses.subjects')
            ->select('video_courses.*','subjects.subject')
            ->get();

        return view('SSC.video.index', ['pdf' => $pdf]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('class','ssc')->get();
        return view('SSC.video.create',['subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'class_name'=>'required',
                'types'=>'required',
                'group'=>'required',
                'subjects'=>'required',
                'title'=>'required',
                'thumbnail'=>'required',
                'url'=>'required'
            ]);

            $data['thumbnail']=$this->uploadFile($data['thumbnail'],'thumbnail/');

            $upload = VideoCourse::create($data);

            return redirect()->back();
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
        $upload = VideoCourse::find($id);
        $subjects = Subject::where('class','ssc')->get();

        return view('SSC.video.edit', ['upload' => $upload, 'subjects' => $subjects]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'class_name'=>'sometimes|required',
                'types'=>'sometimes|required',
                'group'=>'sometimes|required',
                'subjects'=>'sometimes|required',
                'title'=>'sometimes|required',
                'thumbnail'=>'sometimes|required',
                'url'=>'sometimes|required'
            ]);

            $upload = VideoCourse::find($id);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/',$upload->thumbnail);
            }

            $upload->update($data);

                return redirect()->route('video.index');
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $upload = VideoCourse::find($id);


        if ($upload->thumbnail && File::exists(public_path($upload->thumbnail))) {
            File::delete(public_path($upload->thumbnail));
        }

        $upload->delete();

        return redirect()->back();
    }
}
