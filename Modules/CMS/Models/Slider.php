<?php


namespace Modules\CMS\Models;


use App\Models\CachableModel;
use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Modules\User\Models\User;

class Slider extends CachableModel
{
    use CreatedBy,UpdatedBy;
    protected $fillable = [
        'heading','sub_heading','text','link','name','banner','created_by','updated_by'
    ];

    public function creator(): string
    {
        return 'created_by';
    }

    public function editor(): string
    {
        return 'updated_by';
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by')->withTrashed();
    }

    public function lastUpdatedBy(){
        return $this->belongsTo(User::class,'updated_by')->withTrashed();
    }
}
