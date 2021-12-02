<?php


namespace Modules\User\Http\Controllers\Back;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\RoleStoreRequest;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\User\Models\User;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::where('name','!=','Super Admin')->get();
        $permissions = Permission::all();

        return view('user::back.acl.roles',compact('roles','permissions'));
    }

    public function store(RoleStoreRequest $request){
        $role = Role::create([
            'name'=>$request->roleName
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('success','Role created successfully.');
    }

    public function edit($name){
        $role = Role::with(['permissions'])->where('name',$name)->first();
        if(!$role){
            abort(404);
        }
        $permissions = Permission::all();
        return view('user::back.acl.update-role',compact('role','permissions'));
    }

    public function update(RoleStoreRequest $request,$id){
//        $request->validate([
//            'roleName'=>'required|min:3|max:10|unique:roles,name,'.$name,
//            'permissions'=>'required|array|min:2'
//        ],[
//            'roleName.required'=>'Role name is required',
//            'roleName.min'=>'Role name must be 3 chars long',
//            'roleName.max'=>'Role name must not be more than 8 chars',
//            'roleName.unique'=>'Role with this name already exists',
//            'permissions.required'=>'No Permissions selected',
//            'permissions.array'=>'Select at least 2 access',
//            'permissions.min'=>'Select at least 2 access'
//        ]);
        $role = Role::findorfail($id);
        $role->update([
            'name'=>$request->roleName
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('user.roles')->with('success','Role updated successfully');
    }

    public function destroy(Request $request,$name){
        try{
            $role = Role::where('name',$name)->first();
            if(!$role){
                abort(404);
            }
            if(auth()->user()->hasRole($name)){
                abort(403,'You are associated with this role');
            }
            $role->delete();
            return response()->json(['message'=>'Role deleted successfully'],200);
        } catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage()],403);
        }

    }

    public function assignUserRole(Request $request){
        $request->validate([
            'user'=>'required',
            'roles'=>'required|array',
            'roles.*'=>'exists:roles,name'
        ],[
            'user.required'=>'Select valid user to grant role.',
            'roles.required'=>'Select valid roles to be given',
            'roles.array'=>'Select valid roles to be given',
            'roles.*.exists'=>'Select valid roles to be given',
        ]);

        $user = User::where('email',ltrim(explode('-',$request->user)[0]),' ')->first();

        if(!$user){
            abort(404);
        }
        foreach($request->roles as $roleName){
            $role = Role::where('name',$roleName)->first();
            if(!$role){
                continue;
            }
            $user->assignRole($role);
        }

        return redirect()->back()->with('success','User granted selected roles');
    }

    public function detachUserRole(Request $request) {
        $request->validate([
            'detUser'=>'required',
            'detRole'=>'required|array',
            'detRole.*'=>'exists:roles,name'
        ],[
            'detUser.required'=>'Select valid user to grant role.',
            'detRole.required'=>'Select valid roles to be given',
            'detRole.array'=>'Select valid roles to be given',
            'detRole.*.exists'=>'Select valid roles to be given',
        ]);
        $user = User::where('email',$request->detUser)->first();
        if(!$user){
            abort(404);
        }
        $role = Role::where('name',$request->detRole)->first();
        if(!$role){
            abort(404);
        }
        $user->detachRole($role);
        return redirect()->back()->with('success',$role->name.' detached from user');
    }

    public function addPermission(Request $request) {
        $request->validate([
            'permissionName'=>'required|string'
        ],[
            'permissionName.required'=>'Permission name is required',
            'permissionName.string'=>'Invalid data'
        ]);

        $permission = Permission::create([
            'name'=>$request->permissionName
        ]);

        return redirect()
            ->back()
            ->with('success','Permission created successfully.');
    }

}
