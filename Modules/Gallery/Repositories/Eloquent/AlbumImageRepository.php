<?php


  namespace Modules\Gallery\Repositories\Eloquent;


  use Modules\Gallery\Models\AlbumImage;
  use App\Repositories\Eloquent\BaseRepository;
  use Modules\Gallery\Repositories\Contracts\AlbumImageContract;

  class AlbumImageRepository extends BaseRepository implements AlbumImageContract
  {
    public function model()
    {
      return AlbumImage::class;
    }
  }
