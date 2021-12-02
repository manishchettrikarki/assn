<?php


namespace Modules\CMS\Models;


use App\Models\CachableModel;
use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Modules\User\Models\User;

class Page extends CachableModel
{
    use CreatedBy,UpdatedBy;
    protected $fillable = [
        'title','content','tags','nav','publish','slug','created_by','updated_by',
        'menu_name','meta_title','meta_description'
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
        return $this->belongsTo(User::class,'created_by');
    }

    public function lastUpdatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
}
