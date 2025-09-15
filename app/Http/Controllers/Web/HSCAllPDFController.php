<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AllPDF;
use App\Models\HSCClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HSCAllPDFController extends Controller
{
    public function index(){
        $pdf = AllPDF::where('all_p_d_f_s.class_name', 'hsc')
            ->join('subjects', 'subjects.id', '=', 'all_p_d_f_s.subjects')
            ->join('h_s_c_classes', 'h_s_c_classes.id', '=', 'all_p_d_f_s.hsc_year')
            ->select('all_p_d_f_s.*', 'subjects.subject', 'h_s_c_classes.class_name')
            ->get();
        return view('hsc.allPDF.index',['pdf'=>$pdf]);
    }
    public function create()
    {
        $class = HSCClass::all();
        $subject = Subject::where('class','hsc')->get();
        return view('hsc.allPDF.create',['class' => $class,'subjects' => $subject]);
    }

    public function store(Request $request){
        try {
            $data = $request->validate([
                'class_name'=>'required',
                'types'=>'required',
                'group'=>'required',
                'question_types'=>'required',
                'subjects'=>'required',
                'title'=>'required',
                'thumbnail'=>'required',
                'pdf'=>'required',
                'hsc_year'=>'required',
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

    public function edit($id)
    {
        $upload = AllPDF::find($id);
        $subjects = Subject::where('class','hsc')->get();
        $hsc = HSCClass::all();

        return view('hsc.allPDF.edit', ['upload' => $upload, 'subjects' => $subjects,'hsc' => $hsc]);
    }

    public function update(Request $request, $id){
        try {
            $data = $request->validate([
                'class_name'=>'sometimes|required',
                'types'=>'sometimes|required',
                'group'=>'sometimes|required',
                'question_types'=>'sometimes|required',
                'subjects'=>'sometimes|required',
                'title'=>'sometimes|required',
                'thumbnail'=>'sometimes|required',
                'pdf'=>'sometimes|required',
                'hsc_year'=>'sometimes|required',
            ]);

            $upload = AllPDF::find($id);

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/',$upload->thumbnail);
            }
            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/',$upload->pdf);
            }

            $upload->update($data);

            return redirect()->route('hsc.allpdf');
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
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
}
