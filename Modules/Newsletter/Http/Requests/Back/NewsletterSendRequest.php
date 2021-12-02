<?php


namespace Modules\Newsletter\Http\Requests\Back;


use Illuminate\Foundation\Http\FormRequest;

class NewsletterSendRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('send newsletter');
    }

    public function rules()
    {
        return [
            'subject'=>'required|max:30',
            'recipient'=>'required',
            'letter'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required'=>'Subject field is required.',
            'subject.max'=>'Make it short and sweet.',
            'recipient.required'=>'Select recipients.',
            'letter.required'=>'Newsletter content is required.'
        ];
    }
}

