<?php


namespace Modules\Newsletter\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name'=>'required|string|max:20',
            'email'=>'required|email|max:20'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Name is required.',
            'name.string'=>'Provide valid name.',
            'name.max'=>'Provide valid name.',
            'email.required'=>'Email is required.',
            'email.email'=>'Provide valid email.',
            'email.max'=>'Provide valid email.'
        ];
    }
}
