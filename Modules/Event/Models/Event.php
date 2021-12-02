<?php

namespace Modules\Event\Models;

use App\traits\CreatedBy;
use App\traits\UpdatedBy;
use Illuminate\Support\Str;
use App\Models\CachableModel;
use Modules\User\Models\User;

class Event extends CachableModel
{
  use CreatedBy,UpdatedBy;
    protected $fillable = [
      'title','location','description','schedule','start_date','end_date','cover_image','schedule',
      'created_by','updated_by','start_time','slug'
    ];

    protected $appends = ['abstract_description'];

    protected $dates = ['start_date','end_date'];

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

  public function updatedBy()
  {
    return $this->belongsTo(User::class,'updated_by')->withTrashed();
  }

  public function getAbstractDescriptionAttribute()
  {
      return Str::limit(strip_tags($this->description),20);
  }

  public function getCoverImageAttribute($value){
      if(isset($value)){
          return $value;
      }
      return site('logo');
  }
}
