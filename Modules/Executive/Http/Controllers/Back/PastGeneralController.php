<?php

namespace Modules\Executive\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Executive\Models\PastGeneral;


class PastGeneralController extends Controller
{
    public function index()
    {
        $generals = PastGeneral::all();
        return view('executive::back.past-general-secretary.index', compact('generals'));
    }

    public function create()
    {
        return view('executive::back.past-general-secretary.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'tenure' => 'required',
//            'image' => 'mimes:jpg,png,jpeg',
            'duration' => 'required',
        ]);

        $pastGeneralSecretary = PastGeneral::create([
                'name' => $request->name,
                'tenure' => $request->tenure,
                'image' => $request->image,
                'duration' => $request->duration
            ]
        );
        return $this->index();
    }
    public function edit($id){
    $pastGeneralSecretary = PastGeneral::findorfail($id);
    return view ('executive::back.past-general-secretary.edit', compact('pastGeneralSecretary'));
    }
    public function update(Request $request, $id){
//        dd($request);
        $pastGeneralSecretary = PastGeneral::findorfail(decrypt($id));
        $pastGeneralSecretary -> update([
            'name' => $request->name,
            'tenure' => $request->tenure,
            'image' => $request->image,
            'duration' => $request->duration
        ]);
        return redirect()->route('past.general.secretary.index')->with('success','Details Updated Successfully');

    }
    public function delete($id){
        $pastGeneralSecretary = PastGeneral::findorfail($id);
        $pastGeneralSecretary->delete();
        return redirect()->route('past.general.secretary.index')->with('success','Deleted Successfully');
    }
}

