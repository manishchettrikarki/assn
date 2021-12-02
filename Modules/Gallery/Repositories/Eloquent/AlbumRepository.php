<?php


namespace Modules\Gallery\Repositories\Eloquent;


use Modules\Gallery\Models\Album;
use App\Repositories\Eloquent\BaseRepository;
use Modules\Gallery\Repositories\Contracts\AlbumContract;

class AlbumRepository extends BaseRepository implements AlbumContract
{
    public function model(){
      return Album::class;
    }
}
