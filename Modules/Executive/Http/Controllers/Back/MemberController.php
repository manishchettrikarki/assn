<?php
namespace Modules\Executive\Http\Controllers\Back;

use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Executive\Models\Member;
use Modules\Executive\Repositories\Contracts\MemberContract;

class MemberController extends Controller {
    public $memberContract,$activityContract;

    public function __construct(MemberContract $memberContract, ActivityLogContract $activityContract)
    {
        $this->memberContract = $memberContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        return view('executive::back.members.index');
    }

    public function getMemberData(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'image',
            4 => 'hospital',
            5 => 'created_by',
            6 => 'updated_by',
            7 => 'created_at',
            8 => 'actions'
        );
        $totalData = Member::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
                if($limit == -1){
                    $members = Member::orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $members = Member::offset($start)
                        ->limit($limit)
                        ->orderBy('created_at', 'desc')
                        ->get();
                }

            } else {
                if($limit == -1){
                    $members = Member::orderBy($order, $dir)
                        ->get();
                } else {
                    $members = Member::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                }

            }
        } else {
            $search = $request->input('search.value');
            if($limit == -1){
                $members = Member::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('hospital', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $members = Member::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('hospital', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
            $totalFiltered = Member::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('hospital', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($members)) {

            $c = 1;
            foreach ($members as $member) {
                $edit = route('members.edit', encrypt($member->id));
                $delete = route('members.delete', encrypt($member->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $member->name;
                $nestedData['email'] = $member->email;
                $nestedData['image'] = '<img src="'.$member->image.'" height="100" width="100">';
                $nestedData['hospital'] = $member->hospital;
                $nestedData['created_by'] = $member->createdBy->name;
                $nestedData['updated_at'] = $member->updatedBy->name;
                $nestedData['created_at'] = $member->created_at->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('update members')){
                    $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
                }
                if(auth()->user()->can('delete members')){
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
        return view('executive::back.members.create');
    }

    public function store(Request  $request)
    {
        try{
            DB::beginTransaction();
            $member = $this->memberContract->create([
                'name'=>$request->name,
                'hospital'=>$request->hospital,
                'image'=>$request->image,
                'email'=>$request->email
            ]);

            $this->activityContract->create([
                'entity_id'=>$member->id,
                'entity_type'=>'Member',
                'activity'=>'Member with name '.$member->name.' created',
                'link'=>route('members.index'),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->route('members.index')
                ->with('success','Member added successfully.');
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
        $member = $this->memberContract->find(decrypt($id));
        return view('executive::back.members.edit',compact('member'));
    }

    public function update(Request $request,$id){
        $executive = $this->memberContract->find(decrypt($id));
        try{
            DB::beginTransaction();

            $this->memberContract->update($executive->id,[
                'name'=>$request->name,
                'hospital'=>$request->designation,
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
                ->route('members.index')
                ->with('success','Member updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }

    public function destroy($id){
        $executive = $this->memberContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->memberContract->delete($executive->id);
            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Member',
                'activity'=>'Member with name '.$executive->name.' deleted',
                'link'=>route('members.index'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()
                ->route('members.index')
                ->with('success','Member deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }
}
