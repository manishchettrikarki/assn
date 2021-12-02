<?php

namespace Modules\Executive\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Executive\Models\PastGeneral;

class PastGsController extends Controller
{
    public function message()
    {
        $secretaries= PastGeneral::all();
        if (!$secretaries) abort(404);
        return view('executive::past-general-secretary',compact('secretaries'));
    }
}
