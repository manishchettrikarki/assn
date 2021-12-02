<?php

namespace Modules\Executive\Models;

use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class Member extends Model
{
    use CreatedBy, UpdatedBy;
    protected $fillable = [
        'name','email','image','hospital','created_by','updated_by'
    ];

    public function creator(): string
    {
        return 'created_by';
    }

    public function editor(): string
    {
        return 'updated_by';
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by')->withTrashed();
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by')->withTrashed();
    }
    public function getImageAttribute($value)
    {
        if(isset($value)){
            return $value;
        } else {
            return site('logo');
        }
    }
}
