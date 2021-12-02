<?php

namespace Modules\Executive\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Executive\Models\PastPresident;

class PastPresidentController extends Controller
{
    public function message()
    {
        $presidents= PastPresident::all();
        if (!$presidents) abort(404);
        return view('executive::past-presidents',compact('presidents'));
    }
}
