<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HonorsQuestion;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HonorsQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pdf = HonorsQuestion::where('class_name','honors')->where('question','question_pdf')
            ->join('subjects','subjects.id','=','honors_questions.subject')
            ->select('honors_questions.*','subjects.subject')
            ->get();

        return view('honors.question.index', ['pdf' => $pdf]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('class','honors')->get();
        return view('honors.question.create',['subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'class_name'=>'required',
                'question'=>'required',
                'group'=>'required',
                'subject'=>'required',
                'title'=>'required',
                'thumbnail'=>'required',
                'pdf'=>'required'
            ]);

            $data['thumbnail']=$this->uploadFile($data['thumbnail'],'thumbnail/');
            $data['pdf']=$this->uploadFile($data['pdf'],'pdf/');

            $upload = HonorsQuestion::create($data);

//            return response()->json($upload);
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
        $upload = HonorsQuestion::find($id);
        $subjects = Subject::where('class','honors')->get();

        return view('honors.question.edit', ['upload' => $upload, 'subjects' => $subjects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'class_name'=>'sometimes|required',
                'question'=>'sometimes|required',
                'group'=>'sometimes|required',
                'subject'=>'sometimes|required',
                'title'=>'sometimes|required',
                'thumbnail'=>'sometimes|required',
                'pdf'=>'sometimes|required'
            ]);

            $upload = HonorsQuestion::find($id);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/',$upload->thumbnail);
            }

            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/',$upload->pdf);
            }

            $upload->update($data);

            return redirect()->route('honors.index');
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
        $upload = HonorsQuestion::find($id);


        if ($upload->thumbnail && File::exists(public_path($upload->thumbnail))) {
            File::delete(public_path($upload->thumbnail));
        }

        if ($upload->pdf && File::exists(public_path($upload->pdf))) {
            File::delete(public_path($upload->pdf));
        }
        $upload->delete();

        return redirect()->back();
    }
}
