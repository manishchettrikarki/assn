<?php
namespace Modules\Executive\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Executive\Models\ExecutiveBody;

class ExecutiveBodyController extends Controller
{
    public function index()
    {
        $bodies = ExecutiveBody::all();
        return view('executive::back.executive-bodies.index', compact('bodies'));

    }

    public function create()
    {
        return view('executive::back.executive-bodies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'post' => 'required|string'
        ]);
        $executiveBody = ExecutiveBody::create([
            'name' => $request->name,
            'post' => $request->post,
            'image' => $request->image
        ]);
        return $this->index();
    }

    public function edit($id)
    {
        $executiveBody = ExecutiveBody::findorfail($id);
        return view('executive::back.executive-bodies.edit', compact('executiveBody'));
    }

    public function update(Request $request, $id)
    {
        $executiveBody = ExecutiveBody::findorfail(decrypt($id));
        $executiveBody->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image,
            'designation' => $request->designation
        ]);
        return redirect()->route('executive.bodies.index')->with('success', 'Details Updated Successfully');

    }

    public function delete($id)
    {
        $executiveBody = ExecutiveBody::findorfail($id);
        $executiveBody->delete();
        return redirect()->route('executive.bodies.index')->with('success', 'Deleted Successfully');
    }
}
