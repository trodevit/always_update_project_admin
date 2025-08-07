<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ErrorOccurred;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            'class_id' => 'required|integer|exists:add_classes,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'pdf' => 'required|mimes:pdf',
            'offical_url' => 'url',
            'check' => 'required|string'
        ]);

        try {
            $data = $request->all();
            $folder = in_array($data['check'], ['suggestion', 'scholarship', 'result', 'notice'])
                ? $data['check']
                : 'scholarship';

            $pdfFile = $request->file('pdf');
            $imageFile = $request->file('image');

            $pdfFileName = $pdfFile->getClientOriginalName();
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();

            $pdfPath = "$folder/pdfs/$pdfFileName";
            $imagePath = "$folder/images/$imageFileName";

            $pdfFile->move(public_path("$folder/pdfs"), $pdfFileName);
            $imageFile->move(public_path("$folder/images"), $imageFileName);

            $data['pdf'] = $pdfPath;
            $data['image'] = $imagePath;

            Common::create($data);

            return redirect()->back()->with('success', $data['check'] . 'created successfully');
        }
        catch (\Exception $exception){
            Mail::to('rubayetislam16@gmail.com')->send(new ErrorOccurred($exception->getMessage(), $exception->getTraceAsString()));
            return redirect()->back()->withErrors(['Something went wrong', $exception->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, string $id)
    {
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

            return view("{$type}.show", ['common' => $common]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type, string $id)
    {
        $class = AddClass::all();
        $common = Common::join('add_classes','add_classes.id','=','commons.class_id')
            ->select('commons.*','add_classes.class_name as class_name')->find($id);

            return view("{$type}.edit", ['common' => $common,'class'=>$class]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $type, string $id)
    {

            $request->validate([
                'class_id' => 'sometimes|required|integer|exists:add_classes,id',
                'title' => 'sometimes|required|string',
                'description' => 'sometimes|required|string',
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg',
                'pdf' => 'sometimes|required|mimes:pdf',
                'offical_url' => 'sometimes|url',
                'check' => 'sometimes|required|string'
            ]);
        try {
            $data = $request->all();
            $common = Common::find($id);

            $folder = in_array($data['check'], ['suggestion', 'scholarship', 'result', 'notice'])
                ? $data['check']
                : 'scholarship';

            if ($request->hasFile('pdf')) {
                if (file_exists(public_path($common->pdf))) {
                    unlink(public_path($common->pdf));
                }
                $pdfFile = $request->file('pdf');
                $pdfFileName = $pdfFile->getClientOriginalName();
                $pdfPath = "$folder/pdfs/$pdfFileName";
                $pdfFile->move(public_path("$folder/pdfs"), $pdfFileName);
                $data['pdf'] = $pdfPath;
            }

            if ($request->hasFile('image')) {
                if (file_exists(public_path($common->image))) {
                    unlink(public_path($common->image));
                }
                $imageFile = $request->file('image');
                $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
                $imagePath = "$folder/images/$imageFileName";
                $imageFile->move(public_path("$folder/images"), $imageFileName);
                $data['image'] = $imagePath;
            }

            $common->update($data);

            return redirect()->route('common.show', ['type' => $common->check, 'id' => $common->id])->with('success', 'updated successfully');
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            Mail::to('rubayetislam16@gmail.com')->send(new ErrorOccurred($e->getMessage(), $e->getTraceAsString()));
            return redirect()->back()->withErrors(['Something went wrong',$e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $type, string $id)
    {
        try {
            $common = Common::findOrFail($id);

            if ($common->image && file_exists(public_path($common->image))) {
                unlink(public_path($common->image));
            }

            if ($common->pdf && file_exists(public_path($common->pdf))) {
                unlink(public_path($common->pdf));
            }

            $common->delete();

            return redirect()->back()->with('success', ucfirst($type) . ' deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', ucfirst($type) . ' not found.');
        } catch (\Exception $e) {
            Mail::to('rubayetislam16@gmail.com')->send(new ErrorOccurred($e->getMessage(), $e->getTraceAsString()));
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the ' . $type . '.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
