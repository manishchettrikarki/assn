<?php


  namespace App\Http\Request\Back;


  use Illuminate\Validation\Rule;
  use Illuminate\Foundation\Http\FormRequest;

  class SocialLinkStoreRequest extends FormRequest
  {
    public function authorize()
    {
      return true;
    }

    public function rules(){
      return [
        'name'=>['required','max:10',((bool)$this->route('slug'))?
          Rule::unique('social_links','name')
            ->ignore($this->route('slug'),'slug'):''],
        'url'=>'required|url'
      ];
    }

    public function messages()
    {
      return [
        'name.required'=>'Name is required',
        'name.max'=>'Name too long(max:10)',
        'name.unique'=>'Name already exists.',
        'url.required'=>'Url is required.',
        'url.url'=>'Invalid url.'
      ];
    }


  }
