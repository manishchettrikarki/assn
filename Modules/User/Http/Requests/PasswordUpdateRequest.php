<?php


namespace Modules\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'password'=>'required|password',
            'newpassword'=>'required|max:15|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'password.required'=>'This is required.',
            'password.password'=>'Invalid password.',
            'newpassword.required'=>'This is required.',
            'newpassword.max'=>'Too long (max:15)',
            'newpassword.min'=>'Too short(min:8)',
            'newpassword.confirmed'=>'Password does not match.'
        ];
    }
}
