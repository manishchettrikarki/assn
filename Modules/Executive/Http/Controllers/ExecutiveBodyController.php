<?php


namespace Modules\Executive\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Executive\Models\ExecutiveBody;


class ExecutiveBodyController extends Controller
{
    public function message()
    {
        $executiveBodies= ExecutiveBody::all();
        if (!$executiveBodies) abort(404);
        return view('executive::executive-body',compact('executiveBodies'));
    }

}
