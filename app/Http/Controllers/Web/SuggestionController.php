<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $common = Common::where('check','suggestion')
            ->join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')
            ->get();

        return view('suggestion.index', ['common' => $common]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $class = AddClass::all();
        return view('suggestion.create',['class' => $class]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id',
            'title'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'pdf'=>'required|mimes:pdf',
            'offical_url'=>'required|url',
            'check'
        ]);

        $data = $request->all();
        if ($data['check'] == 'suggestion') {

            $pdfFile = $request->file('pdf');
            $imageFile = $request->file('image');

            $pdfFileName = $pdfFile->getClientOriginalName();
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();

            $pdfPath = 'suggestion/pdfs/' . $pdfFileName;
            $imagePath = 'suggestion/images/' . $imageFileName;

            $pdfFile->move(public_path('suggestion/pdfs'), $pdfFileName);
            $imageFile->move(public_path('suggestion/images'), $imageFileName);

            $data['pdf'] = $pdfPath;
            $data['image'] = $imagePath;

            $suggestion = Common::create($data);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

        if ($common->check == 'suggestion') {
            return view('suggestion.show', ['common' => $common]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = AddClass::all();
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

        if ($common->check == 'suggestion') {
            return view('suggestion.edit', ['common' => $common,'class'=>$class]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'class_id'=>'sometimes',
            'title'=>'sometimes|required|string',
            'description'=>'sometimes|required|string',
            'image'=>'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg',
            'pdf'=>'sometimes|required|mimes:pdf',
            'offical_url'=>'sometimes|required|url',
            'check'
        ]);

        $data = $request->all();

        $common = Common::find($id);

        if ($data['check'] == 'suggestion') {
            if ($request->hasFile('pdf')) {
                if (file_exists(public_path($common->pdf))) {
                    unlink(public_path($common->pdf));
                }

                $pdfFile = $request->file('pdf');
                $pdfFileName = $pdfFile->getClientOriginalName();
                $pdfPath = 'notice_board/pdfs/' . $pdfFileName;
                $pdfFile->move(public_path('notice_board/pdfs'), $pdfFileName);

                $data['pdf'] = $pdfPath;
            }

            if ($request->hasFile('image')) {
                if (file_exists(public_path($common->image))) {
                    unlink(public_path($common->image));

                    $imageFile = $request->file('image');
                    $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                    $imagePath = 'notice_board/images/' . $imageFileName;
                    $imageFile->move(public_path('notice_board/images'), $imageFileName);

                    $data['image'] = $imagePath;
                }
            }

            $common->update($data);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $common = Common::find($id);

        if (file_exists(public_path($common->image))) {
            unlink(public_path($common->image));
        }

        if (file_exists(public_path($common->pdf))) {
            unlink(public_path($common->pdf));
        }

        $common->delete();

        return redirect()->back();
    }
}
