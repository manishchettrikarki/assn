<?php


namespace Modules\User\Http\Controllers\Back;


use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserContract;

class UserSuspendController extends Controller
{
    public $userContract,$activityContract;

    public function __construct(UserContract $userContract, ActivityLogContract $activityContract)
    {
        $this->userContract = $userContract;
        $this->activityContract = $activityContract;
    }

    public function suspendUser($id){
        $user = $this->userContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->userContract->update($user->id,[
               'is_active'=>false,
               'suspended_date'=>now(),
               'suspended_by'=>auth()->id()
            ]);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' suspended.',
                'link'=>route('users.view',encrypt($user->id)),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()
                ->route('users.view',encrypt($user->id))
                ->with('success','User suspended successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: Code - '.$e->getCode());
        }
    }

    public function unsuspendUser($id) {
        $user = $this->userContract->find(decrypt($id));
        if($user->is_active){
            return redirect()
                ->back()
                ->with('warning','Invalid action');
        }
        try{
            DB::beginTransaction();
            $this->userContract->update($user->id,[
                'is_active'=>true,
                'suspended_by'=>null,
                'suspended_date'=>null,
            ]);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' unsuspended.',
                'link'=>route('users.view',encrypt($user->id)),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->route('users.view',encrypt($user->id))
                ->with('success','User unsuspended.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: code - '.$e->getMessage());
        }
    }

    public function suspendedUsers(){
        return view('user::back.suspended');
    }

    public function getSuspendedUsers(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'suspended_by',
            5 => 'suspended_date',
            6 => 'actions',
        );
        $totalData = User::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $users = User::where('is_active',false)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $users = User::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->where('is_active',false)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->where('is_active',false)
                ->count();
        }
        $data = array();
        if (!empty($users)) {
            $c = 1;
            foreach ($users as $user) {
                $unsuspend = route('user.unsuspend', encrypt($user->id));
                $view = route('users.view', encrypt($user->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['phone'] = ((bool)$user->phone)?$user->phone:'-';
                $nestedData['suspended_by'] = $user->suspendedBy->name;
                $nestedData['suspended_date'] = $user->suspended_date->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('unsuspend users')){
                    $nestedData['actions'] .= '<a href="'.$unsuspend.'" type="button" class="btn btn-sm btn-outline-success waves-effect waves-light">Unsuspend</a>';
                }
                if(auth()->user()->can('view user details')){
                    $nestedData['actions'] .= ' <a href="'.$view.'" type="button" class="btn btn-sm btn-outline-primary waves-effect waves-light">View</a>';
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
}
