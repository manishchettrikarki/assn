<?php


namespace Modules\User\Http\Requests\Back;


use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'=>'required|max:30',
            'email'=>'required|email|unique:users,email,'.decrypt($this->route('id')),
            'password'=>'nullable|max:20|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'This is required.',
            'name.max'=>'Too long.',
            'email.required'=>'This is required.',
            'email.email'=>'Invalid email.',
            'email.unique'=>'Email already taken.',
            'password.max'=>'Too long (max:20)',
            'password.min'=>'Too short (min:8)'
        ];
    }
}
