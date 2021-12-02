<?php


namespace Modules\Executive\Http\Controllers\Back;


use Modules\Executive\Models\RegionalCoordinator;
use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Executive\Repositories\Contracts\RegionalCoordinatorContract;

class CoordinatorController extends Controller
{
    public $coordinatorContract,$activityContract;

    public function __construct(RegionalCoordinatorContract $coordinatorContract, ActivityLogContract $activityContract)
    {
        $this->coordinatorContract = $coordinatorContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        return view('executive::back.coordinators.index');
    }

    public function getMemberData(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'image',
            4 => 'location',
            5 => 'created_by',
            6 => 'updated_by',
            7 => 'created_at',
            8 => 'actions'
        );
        $totalData = RegionalCoordinator::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
                if($limit == -1){
                    $members = RegionalCoordinator::orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $members = RegionalCoordinator::offset($start)
                        ->limit($limit)
                        ->orderBy('created_at', 'desc')
                        ->get();
                }

            } else {
                if($limit == -1){
                    $members = RegionalCoordinator::orderBy($order, $dir)
                        ->get();
                } else {
                    $members = RegionalCoordinator::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                }

            }
        } else {
            $search = $request->input('search.value');
            if($limit == -1){
                $members = RegionalCoordinator::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')

                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $members = RegionalCoordinator::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
            $totalFiltered = RegionalCoordinator::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('location', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($members)) {

            $c = 1;
            foreach ($members as $member) {
                $edit = route('coordinators.edit', encrypt($member->id));
                $delete = route('coordinators.delete', encrypt($member->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $member->name;
                $nestedData['email'] = $member->email;
                $nestedData['image'] = '<img src="'.$member->image.'" height="100" width="100">';
                $nestedData['designation'] = $member->designation;
                $nestedData['member_type'] = $member->member_type;
                $nestedData['created_by'] = $member->createdBy->name;
                $nestedData['updated_at'] = $member->updatedBy->name;
                $nestedData['created_at'] = $member->created_at->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('update regional coordinators')){
                    $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
                }
                if(auth()->user()->can('delete regional coordinators')){
                    $nestedData['actions'] .= ' <a href="'.$delete.'" type="button" class="btn btn-sm btn-danger waves-effect waves-light">Delete</a>';
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
        return view('executive::back.coordinators.create');
    }

    public function store(Request  $request)
    {
        try{
            DB::beginTransaction();
            $executive = $this->coordinatorContract->create([
                'name'=>$request->name,
                'location'=>$request->location,
                'image'=>$request->image,
                'email'=>$request->email
            ]);

            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Regional Coordinator',
                'activity'=>'Regional Coordinator with name '.$executive->name.' created',
                'link'=>route('coordinators.index'),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->route('coordinators.index')
                ->with('success','Regional Coordinator added successfully.');
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
        $member = $this->coordinatorContract->find(decrypt($id));
        return view('executive::back.coordinators.edit',compact('member'));
    }

    public function update(Request $request,$id){
        $executive = $this->coordinatorContract->find(decrypt($id));
        try{
            DB::beginTransaction();

            $this->coordinatorContract->update($executive->id,[
                'name'=>$request->name,
                'location'=>$request->location,
                'image'=>$request->image,
                'email'=>$request->email
            ]);

            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Regional Coordinator',
                'activity'=>'Regional Coordinator with name '.$executive->name.' updated',
                'link'=>route('coordinators.index'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('coordinators.index')
                ->with('success','Regional Coordinator updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }

    public function destroy($id){
        $executive = $this->coordinatorContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->coordinatorContract->delete($executive->id);
            $this->activityContract->create([
                'entity_id'=>$executive->id,
                'entity_type'=>'Regional Coordinator',
                'activity'=>'Regional Coordinator with name '.$executive->name.' deleted',
                'link'=>route('coordinators.index'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()
                ->route('coordinators.index')
                ->with('success','Regional Coordinator deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getCode());
        }

    }
}
