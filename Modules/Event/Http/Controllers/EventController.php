<?php

namespace Modules\Event\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Event\Models\Event;
use Modules\Event\Repositories\Contracts\EventContract;

class EventController extends Controller
{
  public $eventContract;

  public function __construct(EventContract $eventContract)
  {
    $this->eventContract = $eventContract;
  }

  public function events(Request $request){
      $type=$request->type;
      if($type==='Latest'){
          $events=Event::whereDate('start_date','<',now())->get();
      }else if($type==='Upcoming'){
          $events=Event::whereDate('start_date','>',now())->get();
      }else{
          $events = Event::all();

      }

    return view('event::events',compact('events','type'));
  }

  public function viewEvent($slug){
    $event = $this->eventContract->findWhereFirstOrFail('slug',$slug);
    return view('event::view',compact('event'));
  }

}
