<?php

  namespace Modules\Gallery\Models;

  use App\Models\CachableModel;
  use Illuminate\Database\Eloquent\Model;

  class AlbumImage extends Model
  {
    protected $fillable = [
      'album_id','image'
    ];

    protected $touches = ['album'];

    public function album()
    {
      return $this->belongsTo(Album::class,'album_id');
    }
  }
