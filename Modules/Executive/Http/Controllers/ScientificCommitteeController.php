<?php

namespace Modules\Executive\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Executive\Models\ScientificCommittee;

class ScientificCommitteeController extends Controller
{
    public function message()
    {
        $committees= ScientificCommittee::all();
        if (!$committees) abort(404);
        return view('executive::scientific-committees',compact('committees'));
    }
}
