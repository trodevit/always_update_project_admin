<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HSCClass;
use App\Models\PDFCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HSCPDFController extends Controller
{
    public function index()
    {
        $pdf = PDFCourse::where('p_d_f_courses.class_name','hsc')->where('types','pdf')
            ->join('h_s_c_classes','h_s_c_classes.id','=','p_d_f_courses.hsc_year')
            ->select('p_d_f_courses.*','h_s_c_classes.class_name')
            ->get();
        return view('hsc.pdf.index',['pdf' => $pdf]);
    }

    public function create()
    {
        $class = HSCClass::all();
        return view('hsc.pdf.create',['class'=>$class]);
    }

    public function store(Request $request){
        try {
            $data = $request->validate([
                'class_name' => 'required',
                'types' => 'required',
                'group' => 'required',
                'title' => 'required',
                'thumbnail' => 'required',
                'url' => 'required',
                'pdf' => 'required|mimes:pdf',
                'hsc_year' => 'required',
            ]);

            $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/');
            $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/');

            $upload = PDFCourse::create($data);

            return redirect()->back();
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function edit($id)
    {
        $pdf = PDFCourse::find($id);
        $class = HSCClass::all();
        return view('hsc.pdf.edit', ['pdf' => $pdf,'class'=>$class]);
    }

    public function update(Request $request, $id){
        try {
            $data = $request->validate([
                'class_name' => 'sometimes|required',
                'types' => 'sometimes|required',
                'group' => 'sometimes|required',
                'title' => 'sometimes|required',
                'thumbnail' => 'sometimes|required',
                'url' => 'sometimes|required',
                'pdf' => 'sometimes|required|mimes:pdf',
                'hsc_year' => 'sometimes|required',
            ]);

            $upload = PDFCourse::find($id);

            if($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/', $upload->thumbnail);
            }
            if($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/', $upload->pdf);
            }

            $upload->update($data);

            return redirect()->route('hsc.pdf');
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function destroy($id)
    {
        $upload = PDFCourse::find($id);

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
