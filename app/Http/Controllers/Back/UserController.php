<?php


namespace App\Http\Controllers\Back;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Contracts\UserContract;

class UserController extends Controller
{
    public $userContract;
    public function __construct(UserContract $userContract)
    {
        $this->userContract = $userContract;
    }

    public function search(Request $request){
        if($request->ajax()){
            $search = $request->get('term');
            $result = $this->userContract->search($search);
            $data = array();
            foreach ($result as $hsl) {
                $data[] = $hsl->name . ' - ' . $hsl->email;
            }
            return response()->json($data);
        } else {
            abort(404);
        }
    }
}
