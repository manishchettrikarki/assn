<?php


namespace App\Http\Controllers\Back;


use App\Http\Request\Back\SocialLinkStoreRequest;
use App\Repositories\Contracts\ActivityLogContract;
use App\Repositories\Contracts\SocialLinkContract;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SocialLinkController extends Controller
{
    public $socialLinkContract,$activityContract;
    public function __construct(SocialLinkContract $socialLinkContract, ActivityLogContract $activityContract)
    {
        $this->socialLinkContract = $socialLinkContract;
        $this->activityContract = $activityContract;
    }

    public function index()
    {
        $socialLinks = $this->socialLinkContract->all();
        return view('back.socials.index',compact('socialLinks'));
    }

    public function store(SocialLinkStoreRequest $request)
    {
        try{
            DB::beginTransaction();
           $socialLink =  $this->socialLinkContract->create([
                'name'=>strtolower($request->name),
                'url'=>$request->url,
                'slug'=>Str::slug($request->name,'-')
            ]);

            $this->activityContract->create([
                'entity_id'=>$socialLink->id,
                'entity_type'=>'Social Link',
                'activity'=>'Social link with name '.$socialLink->name.' added',
                'link'=>route('social.links'),
                'type'=>'green'
            ]);

            DB::commit();
            return redirect()->route('social.links')
                ->with('success','Social link added successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode())
                ->withInput();
        }

    }

    public function edit($slug)
    {
        $socialLink = $this->socialLinkContract->findWhereFirstOrFail('slug',$slug);
        return view('back.socials.edit',compact('socialLink'));
    }

    public function update(SocialLinkStoreRequest $request,$slug)
    {
        $socialLink = $this->socialLinkContract->findWhereFirstOrFail('slug',$slug);
        try{
            DB::beginTransaction();
            $this->socialLinkContract->update($socialLink->id,[
               'name'=>strtolower($request->name),
               'url'=>$request->url,
               'slug'=>Str::slug($request->name,'-')
            ]);

            $this->activityContract->create([
                'entity_id'=>$socialLink->id,
                'entity_type'=>'Social Link',
                'activity'=>'Social link with name '.$socialLink->name.' updated',
                'link'=>route('social.links'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('social.links')
                ->with('success','Social link updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode())
                ->withInput();
        }
    }

    public function destroy($slug)
    {
        $socialLink = $this->socialLinkContract->findWhereFirstOrFail('slug',$slug);
        try{
            DB::beginTransaction();
            $this->socialLinkContract->delete($socialLink->id);
            $this->activityContract->create([
                'entity_id'=>$socialLink->id,
                'entity_type'=>'Social Link',
                'activity'=>'Social link with name '.$socialLink->name.' deleted',
                'link'=>route('social.links'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()->route('social.links')
                ->with('success','Social link deleted.');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode());
        }
    }
}
