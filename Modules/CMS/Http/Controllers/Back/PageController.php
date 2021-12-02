<?php


namespace Modules\CMS\Http\Controllers\Back;


use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\CMS\Http\Requests\Back\PageStoreRequest;
use Modules\CMS\Repositories\Contracts\PageContract;

class PageController extends Controller
{
    public $pageContract,$activityContract;
    public function __construct(PageContract $pageContract,ActivityLogContract $activityContract)
    {
        $this->pageContract = $pageContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        $pages = $this->pageContract->all();
        return view('cms::back.pages.pages',compact('pages'));
    }

    public function create(){
        return view('cms::back.pages.create');
    }

    public function store(PageStoreRequest $request){
        try{
            DB::beginTransaction();
            $page = $this->pageContract->create([
                'title'=>$request->title,
                'content'=>$request->description,
                'meta_title'=>$request->metaTitle,
                'meta_description'=>$request->metaDescription,
                'tags'=>$request->tags,
                'menu_name'=>($request->has('menu'))?$request->menuName:'',
                'nav'=>($request->has('menu'))?true:false,
                'publish'=>($request->has('publish'))?true:false,
                'slug'=>Str::slug($request->title)
            ]);
            $this->activityContract->create([
                'entity_id'=>$page->id,
                'entity_type'=>'Page',
                'activity'=>'Page with title '.$page->title.' created',
                'link'=>route('view.page',$page->slug),
                'type'=>'green'
            ]);
            DB::commit();
            return redirect()
                ->route('cms.pages')
                ->with('success','Page Created Successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode())
                ->withInput();
        }
    }

    public function edit($slug){
        $page = $this->pageContract->findWhereFirstOrFail('slug',$slug);
        return view('cms::back.pages.edit',compact('page'));
    }

    public function update(PageStoreRequest $request,$slug){
        $page = $this->pageContract->findWhereFirstOrFail('slug',$slug);
        try{
            DB::beginTransaction();
            $this->pageContract->update($page->id,[
                'title'=>$request->title,
                'content'=>$request->description,
                'meta_title'=>$request->metaTitle,
                'meta_description'=>$request->metaDescription,
                'tags'=>$request->tags,
                'menu_name'=>($request->has('menu'))?$request->menuName:'',
                'nav'=>($request->has('menu'))?true:false,
                'publish'=>($request->has('publish'))?true:false,
                'slug'=>Str::slug($request->title)
            ]);
            $this->activityContract->create([
                'entity_id'=>$page->id,
                'entity_type'=>'Page',
                'activity'=>'Page with title '.$page->title.' updated',
                'link'=>route('view.page',$page->slug),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('cms.pages')
                ->with('success','Page updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode());
        }

    }

    public function destroy($slug){
        $page = $this->pageContract->findWhereFirstOrFail('slug',$slug);
        try{
            DB::beginTransaction();
            $this->pageContract->delete($page->id);
            $this->activityContract->create([
                'entity_id'=>$page->id,
                'entity_type'=>'Page',
                'activity'=>'Page with title '.$page->title.' deleted',
                'link'=>route('cms.pages'),
                'type'=>'red'
            ]);
            DB::commit();
            return redirect()
                ->back()
                ->with('success','Page deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error: '.$e->getCode());
        }

    }
}
