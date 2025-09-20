<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\FCMNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = Suggestion::where('types','notice')->get();
        return view('notice.index',['suggestions'=>$suggestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notice.create');
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
//                'pdf'=>'required|mimes:pdf',
                'official_url'=>'required'
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

        return view('notice.edit',['upload'=>$upload]);
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
//                'pdf'=>'sometimes|required|mimes:pdf',
                'official_url'=>'sometimes|required'
            ]);

            $upload = Suggestion::find($id);

            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request->file('image'), 'suggestion/images/',$upload->image);
            }
            if ($request->hasFile('pdf')) {
                $data['pdf'] = $this->uploadFile($request->file('pdf'), 'suggestion/pdfs/',$upload->pdf);
            }

            $upload->update($data);

            return redirect()->route('notice.index');
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

        return redirect()->back();
    }
}
