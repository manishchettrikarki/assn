<?php

namespace Modules\Executive\Models;

use App\traits\UpdatedBy;
use App\Models\CachableModel;
use Modules\User\Models\User;

class ExecutiveMessage extends CachableModel
{
    protected $table='executive_messages';
  use UpdatedBy;
    protected $fillable = [
      'message','image','updated_by','post','slug'
    ];
  public function editor(): string
  {
    return 'updated_by';
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
