<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AllPDF;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AllPDFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pdf = AllPDF::where('class_name','SSC')->where('types','all_pdf')
            ->join('subjects','subjects.id','=','all_p_d_f_s.subjects')
            ->select('all_p_d_f_s.*','subjects.subject')
            ->get();

        return view('SSC.allPDF.index', ['pdf' => $pdf]);
    }

    public function videoindex()
    {
        $pdf = AllPDF::where('class_name','SSC')->where('types','video_all_pdf')
            ->join('subjects','subjects.id','=','all_p_d_f_s.subjects')
            ->select('all_p_d_f_s.*','subjects.subject')
            ->get();

        return view('SSC.videoallpdf.index', ['pdf' => $pdf]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::where('class','ssc')->get();
        return view('SSC.allPDF.create',['subjects'=>$subjects]);
    }

    public function videocreate()
    {
        $subjects = Subject::where('class','ssc')->get();
        return view('SSC.videoallpdf.create',['subjects'=>$subjects]);
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
                'question_types'=>'required',
                'subjects'=>'required',
                'title'=>'required',
                'thumbnail'=>'required',
                'pdf'=>'required'
            ]);

            $data['thumbnail']=$this->uploadFile($data['thumbnail'],'thumbnail/');
            $data['pdf']=$this->uploadFile($data['pdf'],'pdf/');

            $upload = AllPDF::create($data);

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
        $upload = AllPDF::find($id);
        $subjects = Subject::where('class','ssc')->get();
        if ($upload->type == 'all_pdf') {
            return view('SSC.allPDF.edit', ['upload' => $upload, 'subjects' => $subjects]);
        }
        else{
            return view('SSC.videoallpdf.edit', ['upload' => $upload, 'subjects' => $subjects]);
        }
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
                'question_types'=>'sometimes|required',
                'subjects'=>'sometimes|required',
                'title'=>'sometimes|required',
                'thumbnail'=>'sometimes|required',
                'pdf'=>'sometimes|required'
            ]);

            $upload = AllPDF::find($id);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/',$upload->thumbnail);
            }
            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/',$upload->pdf);
            }

            $upload->update($data);

            if ($data['types'] == 'all_pdf') {
                return redirect()->route('course.SSC.All-PDF');
            }
            else{
                return redirect()->route('course.SSC.All-PDF.video');
            }
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
        $upload = AllPDF::find($id);

        if ($upload->pdf && File::exists(public_path($upload->pdf))) {
            File::delete(public_path($upload->pdf));
        }

        if ($upload->thumbnail && File::exists(public_path($upload->thumbnail))) {
            File::delete(public_path($upload->thumbnail));
        }

        $upload->delete();

        return redirect()->back();
    }

    public function relatedData($id)
    {
        $subject = Subject::findOrFail($id);

        $pdfs = AllPDF::where('subjects', $id)->pluck('title');

        return response()->json([
            'titles' => $pdfs, // send all titles
        ]);
    }

}
