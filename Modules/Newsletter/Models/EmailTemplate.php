<?php

namespace Modules\Newsletter\Models;

use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class EmailTemplate extends Model
{
    use CreatedBy,UpdatedBy,SoftDeletes;
    protected $fillable = [
        'name','subject','template','can_be_deleted','slug','deleted_at','created_by','updated_by'
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

    public function lastUpdatedBy()
    {
        return $this->belongsTo(User::class,'updated_by')->withTrashed();
    }
}
