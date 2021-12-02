<?php


namespace Modules\Newsletter\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Newsletter\Http\Requests\SubscriptionRequest;
use Modules\Newsletter\Jobs\VerifySubscriber;
use Modules\Newsletter\Repositories\Contract\SubscriberContract;

class SubscriptionController extends Controller
{
    public $subscriberContract;
    public function __construct(SubscriberContract $subscriberContract)
    {
        $this->subscriberContract = $subscriberContract;
    }

    public function subscribe(SubscriptionRequest $request){
        if(!$request->ajax()){
            abort(404);
        }
        $subscriber = $this->subscriberContract->findWhereFirst('email',$request->email);
        if(!$subscriber){
            $subscriber = $this->subscriberContract->create([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        }
        if($subscriber->unsuscribed){
            $this->subscriberContract->update($subscriber->id,[
                'unsubscribed'=>false
            ]);
        }
        if(!$subscriber->email_verified){
            dispatch(new VerifySubscriber($subscriber))->delay(now()->addMinute());
        } else {
            return response()->json(['message'=>'You\'re all done.'],200);
        }
        return response()->json(['message'=>'Newsletter Subscribed. Check your inbox'],200);
    }

    public function verify(Request $request){
        try{
            $subscriber = $this->subscriberContract->find(decrypt($request->subscriber));
            $this->subscriberContract->update($subscriber->id,[
                'email_verified'=>true
            ]);
            return redirect()->route('welcome')
                ->with('success','Newsletter Subscription verified.');
        } catch (\Exception $e){
            abort(401);
        }
    }

    public function unsubscribe(Request $request){
        try{
//            dd($request);
            $subscriber = $this->subscriberContract->findWhere('email',decrypt($request->subscriber));
            if(!$subscriber){
                return redirect()->route('welcome')
                    ->with('success','Newsletter unsubscribed.');
            }

            $this->subscriberContract->update($subscriber->id,[
                'unsubscribed'=>true
            ]);
            return redirect()->route('welcome')
                ->with('success','Newsletter unsubscribed.');
        } catch (\Exception $e){
            abort(401);
        }
    }

}
