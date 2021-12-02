<?php

namespace Modules\Newsletter\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Newsletter\Http\Requests\Back\NewsletterSendRequest;
use Modules\Newsletter\Jobs\SendNewsletter;
use Modules\Newsletter\Models\Subscriber;
use Modules\Newsletter\Repositories\Contract\EmailTemplateContract;
use Modules\Newsletter\Repositories\Contract\SubscriberContract;
use Modules\User\Models\User;
use Modules\User\Repositories\Contracts\UserContract;

class NewsletterController extends Controller
{
    public $templateContract,$subscriberContract,$userContract;
    public function __construct(
        EmailTemplateContract $templateContract,
        SubscriberContract $subscriberContract,
        UserContract $userContract)
    {
        $this->templateContract = $templateContract;
        $this->subscriberContract = $subscriberContract;
        $this->userContract = $userContract;
    }

    public function create(){
        $templates = $this->templateContract->all();
        return view('newsletter::back.newsletter.create',compact('templates'));
    }

    public function send(NewsletterSendRequest $request){
        if($request->recipient == 'all'){
          $recipients = $this->getSubscribers()->concat($this->getRegisteredUsers());
        } elseif ($request->recipient == 'verified-users'){
            $recipients = $this->getVerifiedUsers();
        } elseif ($request->recipient == 'all-users'){
            $recipients = $this->getRegisteredUsers();
        } else if($request->recipient == 'subscribers'){
            $recipients = $this->getSubscribers();
        } elseif($request->recipient == 'me'){
            $recipients = collect([(object)[
                'name'=>auth()->user()->name,
                'email'=>auth()->user()->email
            ]]);
        }
        else{
            return redirect()
                ->back()
                ->with('warning','Select valid recipients.')
                ->withInput();
        }
        $subscribers = $recipients->unique();
        dispatch(new SendNewsletter($subscribers,$request->subject, $request->letter))->delay(now()->addMinute());
        return redirect()
            ->back()
            ->with('success','Newsletter Sent.');
    }

    public function getSubscribers(){
       return $this->subscriberContract->geSubscribersList();
    }

    public function getVerifiedUsers(){
       return $this->userContract->getVerifiedUsersEmail();
    }

    public function getRegisteredUsers(){
        return $this->userContract->getUsersEmail();
    }
}
