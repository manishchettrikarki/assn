<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Modules\Event\Models\Event;
use Illuminate\Routing\Controller;
use Modules\CMS\Repositories\Contracts\SliderContract;
use Modules\Executive\Repositories\Contracts\ExecutiveMessageContract;

class HomeController extends Controller
{
    public $sliderContract,$messageContract;
    public function __construct(SliderContract $sliderContract, ExecutiveMessageContract $messageContract){
        $this->sliderContract = $sliderContract;
        $this->messageContract = $messageContract;
    }

    public function home(){
        $banners = $this->sliderContract->all();
        $upcomingEvent = Event::where ('start_date','>=',now())->orderBy('start_date','desc')->first();
        $latestEvent = Event::where ('start_date','<',now())->orderBy('start_date','desc')->limit(3)->get();
        if(!$upcomingEvent || $upcomingEvent->start_date->isBefore(now())){
            $upcomingEvent = false;
        }
        $messages = $this->messageContract->all();
        if(!$messages){
            $messages = false;
        }
        return view('welcome',compact('banners','upcomingEvent','latestEvent','messages'));
    }




}
