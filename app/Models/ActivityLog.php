<?php


namespace App\Models;


use App\traits\CreatedBy;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class ActivityLog extends CachableModel
{
    use CreatedBy;
    protected $fillable = [
       'entity_id','entity_type','activity','link','user_id','type'
    ];

    public function creator(): string
    {
        return 'user_id';
    }

    public function activist(){
        return $this->belongsTo(User::class,'user_id');
    }
}
