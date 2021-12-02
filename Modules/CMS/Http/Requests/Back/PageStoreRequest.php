<?php


namespace Modules\CMS\Http\Requests\Back;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageStoreRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title'=>['required', ((bool)$this->route('slug'))?
                Rule::unique('pages','title')
                    ->ignore($this->route('slug'),'slug'):''],
            'description'=>'required',
            'menuName'=>'required_if:menu,on'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Title is required.',
            'title.unique'=>'Page already exists.',
            'description.required'=>'Page content is required.',
            'menuName.required_if'=>'Menu name is required if to be created.'
        ];
    }
}
