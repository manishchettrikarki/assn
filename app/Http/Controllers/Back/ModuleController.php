<?php


namespace App\Http\Controllers\Back;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
    public function toggleModule(Request $request){
        if($request->ajax()){
            $status = $request->status;
            $moduleName = $request->module;
            $module = Module::find($moduleName);
                if($module){
                    if((bool)$status){
                        Artisan::call('module:disable '.$module->getStudlyName());
                        return response()
                            ->json(['message'=>'Module disabled'],200);
                    } else{
                        Artisan::call('module:enable '.$module->getStudlyName());
                        return response()->json(['message'=>'Module enabled'],200);
                    }
                } else {
                    return response()
                        ->json(['message'=>'Invalid action'],403);
                }

        } else {
            abort(404);
        }
    }
}
