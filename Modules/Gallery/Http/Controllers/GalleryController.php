<?php

namespace Modules\Gallery\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Gallery\Repositories\Contracts\AlbumContract;

class GalleryController extends Controller
{
   public $albumContract;
   public function __construct(AlbumContract $albumContract)
   {
     $this->albumContract = $albumContract;
   }

   public function gallery(){
     $albums = $this->albumContract->paginate(5);
     return view('gallery::index',compact('albums'));
   }

   public function view($code){
     $album = $this->albumContract->findWhereFirstOrFail('album_code',$code);
     return view('gallery::view',compact('album'));
   }
}
