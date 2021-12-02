<?php


namespace Modules\Newsletter\Http\Controllers\Back;


use App\Repositories\Contracts\ActivityLogContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Newsletter\Http\Requests\TemplateStoreRequest;
use Modules\Newsletter\Repositories\Contract\EmailTemplateContract;

class TemplateController extends Controller
{
    public $templateContract,$activityContract;
    public function __construct(EmailTemplateContract $templateContract, ActivityLogContract $activityContract)
    {
        $this->templateContract = $templateContract;
        $this->activityContract = $activityContract;
    }

    public function index(){
        $templates = $this->templateContract->all();
        return view('newsletter::back.templates.index',compact('templates'));
    }

    public function store(TemplateStoreRequest $request){
        try{
            DB::beginTransaction();
            $template = $this->templateContract->create([
                'name'=>$request->name,
                'subject'=>$request->subject,
                'template'=>$request->template,
                'slug'=>Str::slug($request->name,'-')
            ]);

            $this->activityContract->create([
                'entity_id'=>$template->id,
                'entity_type'=>'Email Template',
                'activity'=>'Email template with name '.$template->name.' created',
                'link'=>route('newsletter.templates'),
                'type'=>'green'
            ]);

            DB::commit();

            return redirect()
                ->route('newsletter.templates')
                ->with('success','Template created successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error : '.$e->getCode())
                ->withInput();
        }

    }

    public function show($slug)
    {
        $template = $this->templateContract->findWhereFirstOrFail('slug',$slug);
        $markdown = $template->template;
        return view('newsletter::back.templates.show',compact('markdown'));
    }

    public function edit($slug){
        $template = $this->templateContract->findWhereFirstOrFail('slug',$slug);
        return view('newsletter::back.templates.edit',compact('template'));
    }

    public function update(TemplateStoreRequest $request,$slug){
        $template = $this->templateContract->findWhereFirstOrFail('slug',$slug);
        try{
            DB::beginTransaction();
            $this->templateContract->update($template->id,[
                'name'=>$request->name,
                'subject'=>$request->subject,
                'template'=>$request->template,
                'slug'=>Str::slug($request->name,'-')
            ]);
            $this->activityContract->create([
                'entity_id'=>$template->id,
                'entity_type'=>'Email Template',
                'activity'=>'Email template with name '.$template->name.' updated',
                'link'=>route('newsletter.templates'),
                'type'=>'blue'
            ]);
            DB::commit();
            return redirect()
                ->route('newsletter.templates')
                ->with('success','Template updated successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error : '.$e->getMessage())
                ->withInput();
        }

    }

    public function destroy($slug)
    {
        $template = $this->templateContract->findWhereFirstOrFail('slug',$slug);
        if(!$template->can_be_deleted){
            return redirect()
                ->back()
                ->with('warning','This template can not be deleted.');
        }

        try{
            DB::beginTransaction();

            $this->templateContract->delete($template->id);


            $this->activityContract->create([
                'entity_id'=>$template->id,
                'entity_type'=>'Email Template',
                'activity'=>'Email template with name '.$template->name.' deleted',
                'link'=>route('newsletter.templates'),
                'type'=>'red'
            ]);

            DB::commit();
            return redirect()
                ->route('newsletter.templates')
                ->with('success','Template deleted successfully.');
        } catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->back()
                ->with('warning','Error : '.$e->getCode())
                ->withInput();
        }
    }

    public function template(Request $request){
        if(!$request->ajax()){
            abort(404);
        }
        $template = $this->templateContract->findWhereFirstOrFail('slug',$request->template);
        return response()
            ->json(['content'=>$template->template,'subject'=>$template->subject],200);
    }


}
