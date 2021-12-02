<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\CMS\Repositories\Contracts\PageContract;

class CMSController extends Controller
{
    public $pageContract;
    public function __construct(PageContract $pageContract)
    {
        $this->pageContract = $pageContract;
    }

    public function viewPage($slug){
        $page = $this->pageContract->findWhereFirstOrFail('slug',$slug);
        return view('cms::page',compact('page'));
    }

}
