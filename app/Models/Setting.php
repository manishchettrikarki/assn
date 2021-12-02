<?php


  namespace App\Models;



  use App\traits\UpdatedBy;
  use Modules\User\Models\User;

  class Setting extends CachableModel
  {
    use UpdatedBy;
    protected $fillable = [
      'name','description','logo','logo_sm','primary_email','secondary_email','hunting_line','contact',
      'address','updated_by'
    ];

    public function lastUpdatedBy(){
      return $this->belongsTo(User::class,'updated_by')->withTrashed();
    }

    public function get($key=null, $default=null){
      if($this->$key == null && $default != null){
        return $default;
      }
      if($key == null && $default == null){
        return $this->first();
      }
      if(!is_null($this->first())){
        return $this->first()->$key;
      } else {
        return $default;
      }

    }

    public function getName(){
      return $this->first()->name;
    }

    public function editor(): string
    {
      return 'updated_by';
    }
  }
