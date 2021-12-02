<?php

namespace Modules\Executive\Http\Controllers\Back;

use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Executive\Models\ExecutiveMember;
use Modules\Executive\Repositories\Contracts\ExecutiveMemberContract;

class ExecutiveController extends Controller {
    public $executiveContract, $activityContract;

    public function __construct(ExecutiveMemberContract $executiveContract, ActivityLogContract $activityContract)
    {
        $this->executiveContract = $executiveContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        return view('executive::back.executives.index');
    }

    public function getMemberData(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'image',
            4 => 'designation',
            5 => 'member_type',
            6 => 'created_by',
            7 => 'updated_by',
            8 => 'created_at',
            9 => 'actions'
        );
        $totalData = ExecutiveMember::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
                if($limit == -1){
                    $members = ExecutiveMember::orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $members = ExecutiveMember::offset($start)
                        ->limit($limit)
                        ->orderBy('created_at', 'desc')
                        ->get();
                }

            } else {
                if($limit == -1){
                    $members = ExecutiveMember::orderBy($order, $dir)
                        ->get();
                } else {
                    $members = ExecutiveMember::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                }

            }
        } else {
            $search = $request->input('search.value');
            if($limit == -1){
                $members = ExecutiveMember::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('designation', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('member_type', 'LIKE', '%' . $search . '%')
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $members = ExecutiveMember::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('designation', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('member_type', 'LIKE', '%' . $search . '%')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
            $totalFiltered = ExecutiveMember::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('designation', 'LIKE', '%' . $search . '%')
                ->orWhere('member_type', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($members)) {

            $c = 1;
            foreach ($members as $member) {
                $edit = route('executive.members.edit', encrypt($member->id));
                $delete = route('executive.members.delete', encrypt($member->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $member->name;
                $nestedData['email'] = $member->email;
                $nestedData['image'] = '<img src="'.$member->image.'" height="100" width="100">';
                $nestedData['designation'] = $member->designation;
                $nestedData['member_type'] = $member->member_type;
                $nestedData['created_by'] = $member->createdBy->name;
                $nestedData['updated_by'] = $member->updatedBy->name;
                $nestedData['created_at'] = $member->created_at->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('update executive members')){
                    $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
                }
                if(auth()->user()->can('delete executive members')){
                    $nestedData['actions'] .= ' <a href="'.$delete.'" type="button" class="btn btn-sm btn-secondary waves-effect waves-light">Remove</a>';
                }
                $nestedData['actions'] .= '</div>';
                $c++;
                $data[] = $nestedData;

            }

        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        return view('executive::back.executives.create');
    }

    public function store(Request  $request)
    {

        try{
            DB::beginTransaction();
            $executive = $this->executiveContract->create([
                'name'=>$request->name,
                'designation'=>$request->designation,
                'member_type'=>$request->memberType,
                'image'=>$request->image,
                'email'=>$request->email
            ]);

            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Executive Member',
                'activity'=>'Executive Member with name '.$executive->name.' created',
                'link'=>route('executives.index'),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->route('executives.index')
                ->with('success','Executive Member added successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }

    public function edit($id)
    {
        $executive = $this->executiveContract->find(decrypt($id));
        return view('executive::back.executives.edit',compact('executive'));
    }

    public function update(Request $request,$id){
        $executive = $this->executiveContract->find(decrypt($id));
        try{
            DB::beginTransaction();

             $this->executiveContract->update($executive->id,[
                'name'=>$request->name,
                'designation'=>$request->designation,
                'member_type'=>$request->memberType,
                'image'=>$request->image,
                'email'=>$request->email
            ]);

            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Executive Member',
                'activity'=>'Executive Member with name '.$executive->name.' updated',
                'link'=>route('executives.index'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('executives.index')
                ->with('success','Executive member updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }

    public function destroy($id){
        $executive = $this->executiveContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->executiveContract->delete($executive->id);
            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Executive Member',
                'activity'=>'Executive Member with name '.$executive->name.' deleted',
                'link'=>route('executives.index'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()
                ->route('executives.index')
                ->with('success','Executive member deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }

}
