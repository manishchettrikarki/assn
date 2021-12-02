<?php


namespace App\Http\Controllers\Back;


use App\Repositories\Eloquent\Criteria\LatestFirst;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Repositories\Contracts\TransactionContract;
use Nwidart\Modules\Facades\Module;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['can:view dashboard']);

    }



    public function getFileContents(Request $request) {
        return file_get_contents($request->filename);
    }
}
