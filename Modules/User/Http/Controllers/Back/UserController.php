<?php


namespace Modules\User\Http\Controllers\Back;


use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\User\Http\Requests\Back\UserUpdateRequest;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserContract;
use Modules\User\Scopes\SuperAdminScope;

class UserController extends Controller
{
    public $userContract,$activityContract;
    public function __construct(UserContract $userContract, ActivityLogContract $activityContract)
    {
        $this->userContract = $userContract;
        $this->activityContract = $activityContract;
    }

    public function index(){

        return view('user::back.users.index');
    }

    public function getUserData(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'email_verified_at',
            5 => 'is_active',
            6 => 'created_at',
            7 => 'actions'
        );
        $totalData = User::notSuperAdmin()->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $users = User::notSuperAdmin()->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $users = User::notSuperAdmin()->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::notSuperAdmin()->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($users)) {
            $c = 1;
            foreach ($users as $user) {
                $edit = route('users.edit', encrypt($user->id));
                $view = route('users.view', encrypt($user->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['phone'] = ((bool)$user->phone)?$user->phone:'-';
                $nestedData['email_verified_at'] = ((bool)$user->email_verified_at)?'Verified':'Unverified';
                $nestedData['is_active'] = ($user->is_active)?'Active':'Inactive';
                $nestedData['created_at'] = $user->created_at->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('update users')){
                    $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
                }
                if(auth()->user()->can('view user details')){
                    $nestedData['actions'] .= ' <a href="'.$view.'" type="button" class="btn btn-sm btn-secondary waves-effect waves-light">View</a>';
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

    public function edit($id) {
        $user = $this->userContract->find(decrypt($id));
        return view('user::back.users.edit',compact('user'));
    }

    public function update(UserUpdateRequest $request,$id) {
        $user = $this->userContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->userContract->update($user->id,[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>(isset($request->password))?bcrypt($request->password):$user->password
            ]);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' updated.',
                'link'=>route('users.view',encrypt($user->id)),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()->route('users')
                ->with('success','User updated successfully.');

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: Code - '.$e->getCode());
        }
    }

    public function show($id) {
        $user = $this->userContract->withTrashed()->find(decrypt($id));
        return view('user::back.users.view',compact('user'));
    }

    public function destroy($id) {
        $user = $this->userContract->find(decrypt($id));
        if(!auth()->user()->can('delete users')){
            abort(403);
        }
        try{
            DB::beginTransaction();
            $this->userContract->delete($user->id);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' deleted.',
                'link'=>route('users.deleted'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()->route('users')
                ->with('success','User deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: Code - '.$e->getCode());
        }
    }

    public function delete($id){
        $user = $this->userContract->find(decrypt($id));
        if(!auth()->user()->can('delete users')){
            abort(403);
        }
        try{
            DB::beginTransaction();
            $this->userContract->forceDelete($user->id);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' permanently deleted.',
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()->back()->with('success','User permanently deleted');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: Code - '.$e->getCode());
        }

    }

    public function deletedUsers() {
        return view('user::back.deleted');
    }

    public function restore($id){
        $user = $this->userContract->withTrashed()->find(decrypt($id));
        try {
            DB::beginTransaction();
            $this->userContract->restore($user->id);
            $this->activityContract->create([
                'entity_id'=>$user->id,
                'entity_type'=>'User',
                'activity'=>'User with email '.$user->email.' restored.',
                'link'=>route('users.view',encrypt($user->id)),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->back()
                ->with('success','User restored');
        } catch (\Exception $e){
            DB::rollback();
            return redirect()
                ->back()
                ->with('warning','Error: code - '.$e->getMessage());
        }

    }

    public function deletedUserData(Request $request) {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'deleted_by',
            5 => 'deleted_at',
            6 => 'actions'
        );
        $totalData = User::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            $users = User::onlyTrashed()->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $users = User::onlyTrashed()->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = User::onlyTrashed()->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($users)) {
            $c = 1;
            foreach ($users as $user) {
                $restore = route('users.restore', encrypt($user->id));
                $view = route('users.view', encrypt($user->id));
                $delete = route('users.permanent.delete', encrypt($user->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['phone'] = ((bool)$user->phone)?$user->phone:'-';
                $nestedData['deleted_by'] = ((bool)$user->deleted_by)?$user->deletedBy->name:'-';
                $nestedData['deleted_at'] = $user->deleted_at->toDateTimeString();
                $nestedData['actions'] = '<div class="button-items">';
                if(auth()->user()->can('restore users')){
                    $nestedData['actions'] .= '<a href="'.$restore.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Restore</a>';
                }
                if(auth()->user()->can('view user details')){
                    $nestedData['actions'] .= ' <a href="'.$view.'" type="button" class="btn btn-sm btn-secondary waves-effect waves-light">View</a>';
                }

                if(auth()->user()->can('delete user permanently')){
                    $nestedData['actions'] .= ' <a href="'.$delete.'" type="button" class="btn btn-sm btn-danger waves-effect waves-light">Delete Permanently</a>';
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
