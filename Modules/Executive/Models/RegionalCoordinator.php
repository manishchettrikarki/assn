<?php


namespace Modules\Executive\Models;


use App\Models\CachableModel;
use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Modules\User\Models\User;

class RegionalCoordinator extends CachableModel
{
    use CreatedBy,UpdatedBy;
    protected $fillable = [
        'name','email','location','image','created_by','updated_by'
    ];

    public function creator(): string
    {
        return 'created_by';
    }

    public function editor(): string
    {
        return 'updated_by';
    }

    public function CreatedBy()
    {
        return $this->belongsTo(User::class,'created_by')->withTrashed();
    }

    public function UpdatedBy()
    {
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
