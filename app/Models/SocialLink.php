<?php

  namespace App\Models;


  use App\traits\CreatedBy;
  use App\traits\UpdatedBy;
  use Modules\User\Models\User;

  class SocialLink extends CachableModel
  {
    use CreatedBy,UpdatedBy;
    protected $fillable = ['name','url','slug','created_by','updated_by'];

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

    public function updatedBy()
    {
      return $this->belongsTo(User::class,'updated_by')->withTrashed();
    }

    public function getFirst($key, $default=null){
      if($social = $this->where('name',ucfirst($key))->first()){
        return $social->url;
      } else {
        return $default;
      }
    }
  }
