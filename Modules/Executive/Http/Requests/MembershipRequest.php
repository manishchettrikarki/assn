<?php /** @noinspection ALL */


namespace Modules\Executive\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'q_1'=>'required|in:option_1,option_2,option_3,option_4',
            'name'=>'required|string|max:50',
            'email'=>'required|email|max:50',
            'mobile'=>'required|string|max:10',
            'dob'=>'required|date|date_format:Y-m-d',
            'citizenship'=>'required|string|max:20',
            'gender'=>'string|in:male,female',
            'per_address'=>'required|string|max:50',
            'pro_address'=>'required|string|max:50',
            'designation'=>'required|string|max:50',
            'nmc'=>'required|string|max:20',
            'speciality'=>'required|string|max:50',
            'uni1_degree'=>'required|string|max:50',
            'uni1_name'=>'required|string|max:100',
            'uni1_year'=>'required|number|max_digit:4',
            'uni2_degree'=>'nullalbe|required|string|max:50',
            'uni2_name'=>'nullalbe|required|string|max:100',
            'uni2_year'=>'nullalbe|required|number|max_digit:4',
            'uni3_degree'=>'nullalbe|required|string|max:50',
            'uni3_name'=>'nullalbe|required|string|max:100',
            'uni3_year'=>'nullalbe|required|number|max_digit:4',
            'pp_image'=>'required|image|file|mimes:jpg,jpeg,png|max:2048',
            'signature'=>'nullable|image|file|mimes:jpg,jpeg,png|max:2048',
            'sponsor'=>'nullable|string|max:50',
            'toa'=>'required',
            'g-recaptcha-response'=>['required','recaptcha']
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
