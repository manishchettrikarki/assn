<?php
namespace Modules\Event\Http\Requests\Back;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>['required','max:50',((bool)$this->route('id'))?
                Rule::unique('events','title')
                    ->ignore(decrypt($this->route('id'))):''],
            'location'=>'required|max:30',
            'startDate'=>'required|date|after_or_equal:today',
            'endDate'=>'nullable|date|after_or_equal:startDate',
            'description'=>'required'
        ];
    }
}
