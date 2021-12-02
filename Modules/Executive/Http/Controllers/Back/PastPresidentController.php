<?php


namespace Modules\Executive\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Executive\Models\PastPresident;

class PastPresidentController extends Controller{
 public function index() {
     $presidents = PastPresident::all();
     return view('executive::back.past-presidents.index',compact('presidents'));
 }
 public function create(){
     return view('executive::back.past-presidents.create');
 }
 public function store(Request $request){
    $validated = $request->validate([
        'name' => 'required',
        'tenure'=>'required',
        'image'=>'required',
        'duration'=>'required',
    ]);
    $pastPresident = PastPresident::create([
        'name'=> $request -> name,
        'tenure' => $request -> tenure,
        'image'=>$request->image,
        'duration' => $request -> duration
]);
return $this -> index();
 }
 public function edit($id){
    $pastPresident = PastPresident::findorfail($id);
    return view('executive::back.past-presidents.edit', compact('pastPresident'));
 }
    public function update(Request $request, $id){
        $pastPresident = PastPresident::findorfail(decrypt($id));
        $pastPresident -> update([
            'name'=> $request -> name,
            'email' => $request -> email,
            'image'=>$request-> image,
            'designation' => $request -> designation
        ]);
        return redirect()->route('past.president.index')->with('success','Details Updated Successfully');

    }
    public function delete($id){
        $pastPresident = PastPresident::findorfail($id);
        $pastPresident->delete();
        return redirect()->route('past.president.index')->with('success','Deleted Successfully');
    }
}

