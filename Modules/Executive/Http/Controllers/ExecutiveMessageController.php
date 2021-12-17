<?php


namespace Modules\Executive\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Executive\Models\ExecutiveMessage;


class ExecutiveMessageController extends Controller
{
    public function message($post)
    {
        $message= ExecutiveMessage::where('slug',$post)->first();
        if (!$message) abort(404);
        return view('executive::executive-message',compact('message'));
    }

}
