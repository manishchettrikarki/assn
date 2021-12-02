<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class ContactMailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required|max:30',
            'address'=>'nullable|max:50',
            'email'=>'required|email|max:30',
            'phone'=>'required_if:callme,on',
            'g-recaptcha-response'=>['required','recaptcha'],
            'message'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Provide your name.',
            'name.max'=>'Provide valid name.',
            'address.max'=>'Provide valid address.',
            'email.required'=>'Provide your email.',
            'email.email'=>'Provide valid mail address.',
            'email.max'=>'Provide valid mail address.',
            'phone.required_if'=>'Your number to call.',
            'message.required'=>'Provide your message.',
            'g-recaptcha-response.required'=>'Are you a robot?',
            'g-recaptcha-response.recaptcha'=>'Are you a robot?'
        ];
    }
}
