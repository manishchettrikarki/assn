<?php


namespace Modules\Executive\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Executive\Models\ScientificCommittee;

class ScientificCommitteeController extends Controller{
    public function index() {
        $scientifics = ScientificCommittee::all();
        return view('executive::back.scientific-committee.index',compact('scientifics'));
    }
    public function create(){
        return view('executive::back.scientific-committee.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'image'=>'required',
            'designation'=>'required',
            'member_type'=> 'required'
        ]);
        $scientificCommittee = ScientificCommittee::create([
                'name'=> $request -> name,
                'email' => $request -> email,
                'image'=>$request-> image,
                'designation' => $request -> designation,
                'member_type' => $request -> member_type
            ]);
        return $this -> index();
    }
    public function edit($id){
        $scientificCommittee = ScientificCommittee::findorfail($id);
        return view ('executive::back.scientific-committee.edit', compact('scientificCommittee'));
    }
    public function update(Request $request, $id){
//        dd($request);
        $scientificCommittee = ScientificCommittee::findorfail(decrypt($id));
        $scientificCommittee -> update([
            'name'=> $request -> name,
            'email' => $request -> email,
            'image'=>$request-> image,
            'designation' => $request -> designation,
            'member_type' => $request -> member_type
        ]);
        return redirect()->route('scientific.committee.index')->with('success','Details Updated Successfully');

    }
    public function delete($id){
        $scientificCommittee = ScientificCommittee::findorfail($id);
        $scientificCommittee->delete();
        return redirect()->route('scientific.committee.index')->with('success','Deleted Successfully');
    }
}

