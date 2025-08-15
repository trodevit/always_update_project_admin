<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index(){
        $courses = Course::where('check','suggestion')->get();

        return view('courseSuggestion.index', ['courses' => $courses]);
    }

    public function formulaindex()
    {
        $courses = Course::where('check','formula')->get();

        return view('courseFormula.index', ['courses' => $courses]);
    }

    public function videoindex()
    {
        $courses = Course::where('check','video')->get();

        return view('courseVideo.index', ['courses' => $courses]);
    }

    public function create()
    {
        return view('courseSuggestion.create');
    }

    public function formulacreate()
    {
        return view('courseFormula.create');
    }

    public function videocreate()
    {
        return view('courseVideo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_name'=>'required|string',
            'title'=>'required|string',
            'short_description'=>'string',
            'video_link'=>'url',
            'pdf'=>'mimes:pdf',
            'check'=>'required'
        ]);

        try {
            switch ($data['check']) {
                case 'video':
                    $data['pdf'] = null;
                    break;

                case 'suggestion':
                    $data['video_link'] = null;
                    break;

                case 'formula':
                    $data['video_link'] = null;
                    $data['short_description'] = null;
                    break;
            }

            $folder = $data['check'];

            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($request->file('pdf'), 'course/' . $folder . '/pdfs/');
            }
            $course = Course::create($data);

            return redirect()->back()->with('success',$data['check'].' '.'Added.');
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['Something went wrong', $e->getMessage()])->withInput();
        }
    }

    public function show(string $type, string $id)
    {
        $course = Course::findOrFail($id);

        return view('courseSuggestion.show', ['course' => $course]);
    }

    public function edit(string $type, string $id)
    {
        $course = Course::findOrFail($id);

        return view('courseSuggestion.edit', ['course' => $course]);
    }

    public function update(Request $request,string $type, string $id)
    {

        try {
        $data = $request->validate([
            'class_name'=>'required|string',
            'title'=>'sometimes|required|string',
            'short_description'=>'sometimes|string',
            'video_link'=>'sometimes|url',
            'pdf'=>'sometimes|mimes:pdf',
            'check'=>'required'
        ]);


            $course = Course::findOrFail($id);


            switch ($data['check']) {
                case 'video':
                    $data['pdf'] = null;
                    break;

                case 'suggestion':
                    $data['video_link'] = null;
                    break;

                case 'formula':
                    $data['video_link'] = null;
                    $data['short_description'] = null;
                    break;
            }

            $folder = $data['check'];

            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($request->file('pdf'), 'course/' . $folder . '/pdfs/',$course->pdf);
            }

            $course->update($data);

            return redirect()->route('course.show',['type'=>$course->check,'id'=>$course->id])->with('success', $type.' '.'Updated.');
//            return response()->json($course);
        }

        catch (\Exception $e) {
            return response()->json($e->getMessage(),500);
        }
    }

    public function destroy(string $type, string $id)
    {
        $course = Course::findOrFail($id);

        if ($course->pdf && File::exists(public_path($course->pdf))) {
            File::delete(public_path($course->pdf));
        }

        $course->destroy($id);
        return redirect()->back()->with('success', $type.' '.'Deleted.');
    }
}
