<?php


namespace Modules\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'roleName'=>'required|min:3|max:10|unique:roles,name'.(((bool)$this->route('id'))?','.$this->route('id'):''),
            'permissions'=>'required|array|min:2'
        ];
    }

    public function messages()
    {
        return [
            'roleName.required'=>'Role name is required',
            'roleName.min'=>'Role name must be 3 chars long',
            'roleName.max'=>'Role name must not be more than 8 chars',
            'roleName.unique'=>'Role with this name already exists',
            'permissions.required'=>'No Permissions selected',
            'permissions.array'=>'Select at least 2 access',
            'permissions.min'=>'Select at least 2 access'
        ];
    }
}
