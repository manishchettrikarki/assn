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
            'title'=>'required|in:Mr.,Mrs.,Miss.',
            'name'=>'required|string|max:30',
            'country'=>'required|string|max:30',
            'state'=>'required|string|max:30',
            'city'=>'required|string|max:30',
            'pinCode'=>'nullable|numeric',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'landline'=>'nullable|numeric',
            'clinic'=>'nullable|numeric',
            'gender'=>'required|in:male,female',
            'dob'=>'required',
            'photo'=>'required|mimes:jpeg,jpg,png|max:2048',
            'mbbs'=>'required|mimes:jpeg,jpg,png|max:2048',
            'ortho'=>'required|mimes:jpeg,jpg,png|max:2048',
            'other'=>'required|mimes:jpeg,jpg,png|max:2048',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Select your salutation',
            'title.in'=>'Select your salutation from the list.',
            'name.required'=>'Provide your full name.',
            'name.string'=>'Provide your valid name.',
            'name.max'=>'Provide your valid name(max:30).',
            'country.required'=>'Provide your country name.',
            'country.string'=>'Provide your valid country name.',
            'country.max'=>'Provide your valid country name(max:30).',
            'state.required'=>'Provide your state name.',
            'state.string'=>'Provide your valid state name.',
            'state.max'=>'Provide your valid state name(max:30).',
            'city.required'=>'Provide your city name.',
            'city.string'=>'Provide your valid city name.',
            'city.max'=>'Provide your valid city name(max:30).',
            'pinCode.required'=>'Provide postal code of your city.',
            'pinCode.numeric'=>'Provide valid postal code.',
            'email.required'=>'Provide your email address.',
            'email.email'=>'Provide valid email address.',
            'mobile.required'=>'Provide your mobile number.',
            'mobile.numeric'=>'Provide valid mobile number eg: 98********.',
            'landline.required'=>'Provide your residential phone number.',
            'landline.numeric'=>'Provide valid phone number eg:01******.',
            'clinic.numeric'=>'Provide valid phone number eg:01******.',
            'clinic.required'=>'Provide your clinic contact number.',
            'gender.required'=>'Select your sexual orientation.',
            'gender.in'=>'Select your sexual orientation from the list.',
            'dob.required'=>'Provide your date of birth.',
            'photo.required'=>'Upload your recent photograph.',
            'photo.mimes'=>'Upload a valid photo(jpeg,jpg,png).',
            'photo.max'=>'File size too large(max: 2MB).',
            'mbbs.required'=>'Upload your MBBS crtificate.',
            'mbbs.mimes'=>'Upload a valid scanned document(jpeg,jpg,png).',
            'mbbs.max'=>'File size too large(max: 2MB).',
            'ortho.required'=>'Provide your MS/DNB/D.Orth Certificate.',
            'ortho.mimes'=>'Upload a valid scanned document(jpeg,jpg,png).',
            'ortho.max'=>'File size too large(max: 2MB).',
            'other.mimes'=>'Upload a valid scanned document(jpeg,jpg,png).',
            'other.max'=>'File size too large(max: 2MB).',
            'other.required'=>'Upload scan copy of bank voucher.',
            'other.mimes'=>'Upload a valid scanned document(jpeg,jpg,png).',
            'other.max'=>'File size too large(max: 2MB).',
            'other.mimes'=>'Upload a valid scanned document(jpeg,jpg,png).',
            'g-recaptcha-response.required'=>'Verify that you are not robot.',
            'g-recaptcha-response.recaptcha'=>'Verify that you are not robot.'
        ];
    }
}
