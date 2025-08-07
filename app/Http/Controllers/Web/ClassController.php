<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ErrorOccurred;
use App\Models\AddClass;
use App\Models\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = [];

        if ($request->has('show')) {
            $classes = AddClass::latest()->get();
        }

        return view('classes.create', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_name'=>'required',
        ]);

        $class = AddClass::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $class = AddClass::find($id);

        $classes = [];

        if ($request->has('show') && in_array($request->show, ['suggestion', 'scholarship','notice','result'])) {
            $classes = Common::where('class_id', $class->id)
                ->where('check', $request->show)
                ->join('add_classes', 'add_classes.id', '=', 'commons.class_id')
                ->select('commons.*', 'add_classes.class_name')
                ->get();
        }


        return view('classes.show', ['class' => $class, 'classes' => $classes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = AddClass::find($id);
        return view('classes.edit', ['class' => $class]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'class_name'=>'required',
        ]);

        $class = AddClass::find($id)->update($data);

        return redirect()->route('class.show',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $class = AddClass::findOrFail($id); // 404 if not found

            $class->delete();

            return redirect()->back();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Class not found.'
            ], 404);

        } catch (\Exception $e) {
            Mail::to('rubayetislam16@gmail.com')->send(new ErrorOccurred($e->getMessage(), $e->getTraceAsString()));
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while deleting the class.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
