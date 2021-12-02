<?php


namespace Modules\Executive\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Executive\Models\ProvincialRepresentative;

class ProvincialRepresentativeController extends Controller{
    public function index() {
        $provincials = ProvincialRepresentative::all();
        return view('executive::back.provincial-representative.index',compact('provincials'));
    }
    public function create(){
        return view('executive::back.provincial-representative.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'image'=>'required',
            'designation'=>'required',
        ]);
        $provincialRepresentative = ProvincialRepresentative::create([
            'name'=> $request -> name,
            'email' => $request -> email,
            'image'=>$request-> image,
            'designation' => $request -> designation,
        ]);
        return $this -> index();
    }
    public function edit($id){
        $provincial = ProvincialRepresentative::findorfail($id);
        return view ('executive::back.provincial-representative.edit', compact('provincial'));
    }
    public function update(Request $request, $id){
        $provincial = ProvincialRepresentative::findorfail(decrypt($id));
        $provincial -> update([
            'name'=> $request -> name,
            'email' => $request -> email,
            'image'=>$request-> image,
            'designation' => $request -> designation
        ]);
        return redirect()->route('provincial.representative.index')->with('success','Details Updated Successfully');

    }
    public function delete($id){
        $provincial = ProvincialRepresentative::findorfail($id);
        $provincial->delete();
        return redirect()->route('provincial.representative.index')->with('success','Deleted Successfully');
    }
}

