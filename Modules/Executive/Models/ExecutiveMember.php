<?php

namespace Modules\Executive\Models;

use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class ExecutiveMember extends Model
{
  use CreatedBy,UpdatedBy;
    protected $fillable = [
      'name','designation','email','image','member_type','created_by','updated_by'
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
    return $this->belongsTo(User::class,'created_by');
  }

  public function updatedBy()
  {
    return $this->belongsTo(User::class,'updated_by');
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
