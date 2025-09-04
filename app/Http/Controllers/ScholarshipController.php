<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\FCMNotification;
use Illuminate\Support\Facades\File;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = Suggestion::where('types','scholarship')->get();
        return view('scholarship.index',['suggestions'=>$suggestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scholarship.create');
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
                'title'=>'required',
                'description'=>'required',
                'image'=>'required',
                'pdf'=>'required|mimes:pdf',
            ]);

            // dd($data);

            $data['image'] = $this->uploadFile($request->file('image'),'scholarship/images/');
            $data['pdf'] = $this->uploadFile($request->file('pdf'),'scholarship/pdfs/');

            $upload = Suggestion::create($data);

            $user = User::all();

            foreach ($user as $users) {
                $users->notify(new FCMNotification($data['title'], $data['description']));
            }


            return redirect()->back();
        }catch (\Exception $e){
            return response()->json(['error' => 'Something went wrong: '.$e->getMessage()], 500);
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
        $upload = Suggestion::find($id);

        return view('scholarship.edit',['upload'=>$upload]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'class_name'=>'required',
                'types'=>'required',
                'title'=>'sometimes|required',
                'description'=>'sometimes|required',
                'image'=>'sometimes|required',
                'pdf'=>'sometimes|required|mimes:pdf',
            ]);

            $upload = Suggestion::find($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'suggestion/images/',$upload->image);
            }
            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($request->file('pdf'), 'suggestion/pdfs/',$upload->pdf);
            }

            $upload->update($data);

            return redirect()->route('scholarship.index');
        }catch (\Exception $e){
            return response()->json(['error' => 'Something went wrong: '.$e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suggestion = Suggestion::find($id);

        if ($suggestion->image && File::exists(public_path($suggestion->image))) {
            File::delete(public_path($suggestion->image));
        }

        if ($suggestion->pdf && File::exists(public_path($suggestion->pdf))) {
            File::delete(public_path($suggestion->pdf));
        }

        $suggestion->delete();

        return response()->json('Suggestion successfully deleted');
    }
}
