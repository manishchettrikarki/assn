<?php

  namespace Modules\Gallery\Models;

  use App\traits\CreatedBy;
  use App\traits\UpdatedBy;
  use App\Models\CachableModel;
  use Modules\User\Models\User;

  class Album extends CachableModel
  {
    use CreatedBy,UpdatedBy;
    protected $fillable = [
      'name','description','tags','album_code','created_by','updated_by'
    ];

    protected $touches = ['images'];

    public function images()
    {
      return $this->hasMany(AlbumImage::class,'album_id');
    }

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
  }
