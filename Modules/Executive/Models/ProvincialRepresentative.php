<?php

namespace Modules\Executive\Models;

use Illuminate\Database\Eloquent\Model;

class ProvincialRepresentative extends Model
{
    protected $fillable = [
        'name','email', 'image', 'designation'
    ];
    public function getImageAttribute($value){
        if(isset($value)){
            return $value;
        }else{
            return site('logo');
        }
    }
}
