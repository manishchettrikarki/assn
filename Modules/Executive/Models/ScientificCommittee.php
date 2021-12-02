<?php

namespace Modules\Executive\Models;

use Illuminate\Database\Eloquent\Model;

class ScientificCommittee extends Model
{
    protected $fillable = [
        'name','email', 'image', 'designation', 'member_type'
    ];
    public function getImageAttribute($value){
        if(isset($value)){
            return $value;
        }else{
            return site('logo');
        }
    }
}
