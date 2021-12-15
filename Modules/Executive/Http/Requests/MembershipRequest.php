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

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
