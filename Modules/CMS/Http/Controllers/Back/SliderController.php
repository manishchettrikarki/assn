<?php


namespace Modules\CMS\Http\Controllers\Back;


use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CMS\Http\Requests\Back\SliderStoreRequest;
use Modules\CMS\Repositories\Contracts\SliderContract;

class SliderController extends Controller
{
    public $sliderContract,$activityContract;
    public function __construct(SliderContract $sliderContract, ActivityLogContract $activityContract)
    {
        $this->sliderContract = $sliderContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        $sliders = $this->sliderContract->all();
        return view('cms::back.sliders.index',compact('sliders'));
    }

    public function store(SliderStoreRequest $request){
        try{
            DB::beginTransaction();
            $slider = $this->sliderContract->create([
                'heading'=>$request->heading,
                'sub_heading'=>$request->subHeading,
                'text'=>$request->text,
                'banner'=>$request->banner,
                'link'=>($request->has('hasButton'))?$request->btnLink:null,
                'name'=>($request->has('hasButton'))?$request->btnText:null,
            ]);

            $this->activityContract->create([
                'entity_id'=>$slider->id,
                'entity_type'=>'Slider',
                'activity'=>'New slider with image '.$slider->banner.' created',
                'link'=>route('cms.sliders'),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->back()
                ->with('success','Slider added successfully');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('warning','Error: '.$e->getMessage());
        }

    }

    public function edit($id){
        $slider = $this->sliderContract->find(decrypt($id));
        return view('cms::back.sliders.update',compact('slider'));
    }

    public function update(SliderStoreRequest $request, $id){
        $slider = $this->sliderContract->find(decrypt($id));
        try{
            DB::beginTransaction();
            $this->sliderContract->update($slider->id,[
                'heading'=>$request->heading,
                'sub_heading'=>$request->subHeading,
                'text'=>$request->text,
                'banner'=>$request->banner,
                'link'=>($request->has('hasButton'))?$request->btnLink:null,
                'name'=>($request->has('hasButton'))?$request->btnText:null,
            ]);
            $this->activityContract->create([
                'entity_id'=>$slider->id,
                'entity_type'=>'Slider',
                'activity'=>'Slider with banner '.$slider->banner.' updated',
                'link'=>route('cms.sliders'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('cms.sliders')
                ->with('success','Slider updated successfully');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode())
                ->withInput();
        }
    }

    public function destroy($id){
        try{
            DB::beginTransaction();

            $slider = $this->sliderContract->find(decrypt($id));
            $this->sliderContract->delete($slider->id);

            $this->activityContract->create([
                'entity_id'=>$slider->id,
                'entity_type'=>'Slider',
                'activity'=>'Slider with banner '.$slider->banner.' deleted',
                'link'=>route('cms.sliders'),
                'type'=>'red'
            ]);

            DB::commit();
            return redirect()
                ->route('cms.sliders')
                ->with('success','Slider deleted successfully.');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->route('cms.sliders')
                ->with('success','Slider deleted successfully.');
        }
    }
}
