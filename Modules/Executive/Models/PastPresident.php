<?php

namespace Modules\Executive\Models;

use Illuminate\Database\Eloquent\Model;

class PastPresident extends Model
{
    protected $fillable = [
        'name','tenure','duration','image'
    ];

    public function getImageAttribute($value){
        if(isset($value)){
            return $value;
        }else{
            return site('logo');
        }
    }
}
