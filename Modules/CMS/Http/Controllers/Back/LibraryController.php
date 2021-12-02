<?php


namespace Modules\CMS\Http\Controllers\Back;


use Illuminate\Routing\Controller;

class LibraryController extends Controller
{
    public function index(){
        return view('cms::back.library');
    }
}
