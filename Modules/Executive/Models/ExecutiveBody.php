<?php

namespace Modules\Executive\Models;

use Illuminate\Database\Eloquent\Model;

class ExecutiveBody extends Model
{
    protected $fillable = [
        'name','post','image'
    ];
    public function getImageAttribute($value){
        if(isset($value)){
            return $value;
        }else{
            return site('logo');
        }
    }
}
