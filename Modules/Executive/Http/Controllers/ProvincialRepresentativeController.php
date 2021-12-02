<?php

namespace Modules\Executive\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Executive\Models\ProvincialRepresentative;

class ProvincialRepresentativeController extends Controller
{
    public function message()
    {
        $representatives= ProvincialRepresentative::all();
        if (!$representatives) abort(404);
        return view('executive::provincial-representative',compact('representatives'));
    }
}
