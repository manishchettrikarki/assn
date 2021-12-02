<?php


namespace App\Http\Controllers\Back;


use App\Http\Request\Back\SettingUpdateRequest;
use App\Repositories\Contracts\ActivityLogContract;
use App\Repositories\Contracts\SettingContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public $settingContract,$activityContract;

    public function __construct(SettingContract $settingContract, ActivityLogContract $activityContract)
    {
        $this->settingContract = $settingContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        $setting = $this->settingContract->first();
        if(!$setting){
            $setting = $this->settingContract->create([]);
        }
        return view('back.setting',compact('setting'));
    }

    public function update(SettingUpdateRequest $request){
        try{
            DB::beginTransaction();
            $setting = $this->settingContract->first();
            $this->settingContract->update($setting->id,[
                'name'=>$request->name,
                'description'=>$request->description,
                'logo'=>$request->logo,
                'primary_email'=>$request->primaryEmail,
                'secondary_email'=>$request->secondaryEmail,
                'hunting_line'=>$request->huntingLine,
                'contact'=>$request->contact,
                'address'=>$request->address
            ]);

            $this->activityContract->create([
                'entity_id'=>$setting->id,
                'entity_type'=>'Site Setting',
                'activity'=>'Site setting updated.',
                'link'=>route('site.settings'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->back()
                ->with('success','Site settings updated successfully.');

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode())
                ->withInput();
        }
    }
}
