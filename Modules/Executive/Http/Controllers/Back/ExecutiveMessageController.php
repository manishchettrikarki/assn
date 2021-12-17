<?php


  namespace Modules\Executive\Http\Controllers\Back;



  use Illuminate\Http\Request;
  use Illuminate\Routing\Controller;
  use Illuminate\Support\Facades\DB;
  use App\Repositories\Contracts\ActivityLogContract;
  use Illuminate\Support\Str;
  use Modules\Executive\Models\ExecutiveMessage;
  use Modules\Executive\Repositories\Contracts\ExecutiveMessageContract;

  class ExecutiveMessageController extends Controller
  {
    public $messageContract, $activityContract;
    public function __construct(ExecutiveMessageContract $messageContract, ActivityLogContract $activityContract)
    {
      $this->messageContract = $messageContract;
      $this->activityContract = $activityContract;
    }

    public function index(){
      $messages = $this->messageContract->all();
      return view('executive::back.executive-message.index',compact('messages'));
    }
    public function create(){
        return view('executive::back.executive-message.create');
    }
    public function store(Request $request){
        $request->validate([
            'post'=>'required|max:50|unique:executive_messages,post',
            'message'=>'required'
        ]);
        $this->messageContract->create(
            [
                'post'=>$request->post,
                'message'=>$request->message,
                'image'=>$request->image,
                'slug'=> Str::slug($request->post,'-')
            ]
        );
    return redirect()->route('executive.message')->with('success','Message added for '.$request->post);
    }
    public function edit($id){
        $executiveMessage = ExecutiveMessage::findorfail($id);
        return view ('executive::back.executive-message.edit', compact('executiveMessage'));
    }
      public function update(Request $request, $id){
          $executiveMessage = ExecutiveMessage::findorfail(decrypt($id));
          $executiveMessage -> update([
              'post'=> $request -> post,
              'message' => $request -> message,
              'image'=>$request-> image,
              'slug'=>Str::slug($request->post,'-')
          ]);
          return redirect()->route('executive.message')->with('success','Details Updated Successfully');

      }
      public function delete($id){
          $executiveMessage= ExecutiveMessage::findorfail($id);
          $executiveMessage->delete();
          return redirect()->route('executive.message')->with('success','Deleted Successfully');
      }
  }

//    public function update(Request $request)
//    {
//      $request->validate([
//        'word'=>'required',
//        'image'=>'required|url'
//      ],[
//        'word.required'=>'Message is required.',
//        'image.required'=>'Image is required.',
//        'image.url'=>'Use image from lilbrary.'
//      ]);
//      try{
//        DB::beginTransaction();
//        $message = $this->messageContract->first();
//        $this->messageContract->update($message->id,[
//          'message'=>$request->word,
//          'image'=>$request->image
//        ]);
//
//        $this->activityContract->create([
//          'entity_id'=>$message->id,
//          'entity_type'=>'Executive Messages',
//          'activity'=>'Executive Message updated',
//          'link'=>route('executive.message'),
//          'type'=>'green'
//        ]);
//        DB::commit();
//        return redirect()->route('executive.message')
//          ->with('success','Message updated successfully.');
//
//      } catch (\Exception $e){
//        DB::rollBack();
//        return redirect()
//          ->back()
//          ->withInput()
//          ->with('warning','Error: '.$e->getCode());
//      }
//
//    }
//  }
