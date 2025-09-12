<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PDFCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShortcutController extends Controller
{
    public function index()
    {
        $pdf = PDFCourse::where('class_name','SSC')->where('types','technique')->get();
        return view('SSC.shortcut.index',['pdf' => $pdf]);
    }

    public function videoindex()
    {
        $pdf = PDFCourse::where('class_name','SSC')->where('types','video_technique')->get();
        return view('SSC.videoshortcut.index',['pdf' => $pdf]);
    }

    public function create(){
        return view('SSC.shortcut.create');
    }

    public function videocreate(){
        return view('SSC.videoshortcut.create');
    }

    public function store(Request $request){
//        dd($request->all());
        try {
            $data = $request->validate([
                'class_name' => 'required',
                'types' => 'required',
                'group' => 'required',
                'title' => 'required',
                'thumbnail' => 'required',
                'url' => 'required',
                'pdf' => 'required|mimes:pdf'
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

    public function edit($id){
        $pdf = PDFCourse::find($id);

        if ($pdf->types == 'technique') {
            return view('SSC.shortcut.edit', ['pdf' => $pdf]);
        }
        else{
            return view('SSC.videoshortcut.edit', ['pdf' => $pdf]);
        }
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
                'pdf' => 'sometimes|required|mimes:pdf'
            ]);

            $upload = PDFCourse::find($id);

            if($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadFile($data['thumbnail'], 'thumbnail/', $upload->thumbnail);
            }
            if($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($data['pdf'], 'pdf/', $upload->pdf);
            }

            $upload->update($data);

            if ($upload->types == 'technique') {
                return redirect()->route('course.SSC.Shortcut.index');
            }
            else{
                return redirect()->route('course.SSC.Shortcut.index.video');
            }
        }
        catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }

    public function destroy($id){
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
