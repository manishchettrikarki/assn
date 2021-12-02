<?php


namespace Modules\Newsletter\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateStoreRequest extends FormRequest
{
    public function authorize()
    {
        return ((bool)$this->route('slug'))?
            auth()->user()->can('update email templates'):
            auth()->user()->can('create email templates');
    }

    public function rules()
    {
        return [
            'name'=>['required','string','max:20',
                ((bool)$this->route('slug'))?
                    Rule::unique('email_templates','name')
                        ->ignore($this->route('slug'),'slug'):''],
            'subject'=>'required|string|max:30',
            'template'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Template name is required.',
            'name.string'=>'Provide a valid name.',
            'name.max'=>'Name too long (max:10).',
            'subject.required'=>'Template subject is required.',
            'subject.string'=>'Provide a valid subject.',
            'subject.max'=>'Subject too long (max:15).',
            'template.required'=>'Design your template here.'
        ];
    }
}
