<?php


  namespace Modules\Event\Http\Controllers\Back;


  use Illuminate\Support\Str;
  use Illuminate\Http\Request;
  use Modules\Event\Models\Event;
  use Illuminate\Routing\Controller;
  use Illuminate\Support\Facades\DB;
  use App\Repositories\Contracts\ActivityLogContract;
  use Modules\Event\Repositories\Contracts\EventContract;
  use Modules\Event\Http\Requests\Back\EventStoreRequest;

  class EventController extends Controller
  {
    public $eventContract,$activityContract;
    public function __construct(EventContract $eventContract,ActivityLogContract $activityContract)
    {
      $this->eventContract = $eventContract;
      $this->activityContract = $activityContract;
    }

    public function index()
    {
      return view('event::back.events.index');
    }


    public function getEventData(Request $request) {
    if(!$request->ajax()){
        abort(404);
    }
      $columns = array(
        0 => 'id',
        1 => 'title',
        2 => 'location',
        3 => 'cover_image',
        4 => 'start_date',
        5 => 'created_by',
        6 => 'updated_by',
        7 => 'created_at',
        8 => 'actions'
      );
      $totalData = Event::count();
      $totalFiltered = $totalData;
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
      if (empty($request->input('search.value'))) {
        if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
          if($limit == -1){
            $events = Event::orderBy('created_at', 'desc')
              ->get();
          } else {
            $events = Event::offset($start)
              ->limit($limit)
              ->orderBy('created_at', 'desc')
              ->get();
          }

        } else {
          if($limit == -1){
            $events = Event::orderBy($order, $dir)
              ->get();
          } else {
            $events = Event::offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
          }

        }
      } else {
        $search = $request->input('search.value');
        if($limit == -1){
          $events = Event::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('location', 'LIKE', '%' . $search . '%')
            ->orWhere('start_date', 'LIKE', '%' . $search . '%')
            ->orderBy($order, $dir)
            ->get();
        } else {
          $events = Event::where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('location', 'LIKE', '%' . $search . '%')
            ->orWhere('start_date', 'LIKE', '%' . $search . '%')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }
        $totalFiltered = Event::where('title', 'LIKE', '%' . $search . '%')
          ->orWhere('location', 'LIKE', '%' . $search . '%')
          ->orWhere('start_date', 'LIKE', '%' . $search . '%')
          ->count();
      }
      $data = array();
      if (!empty($events)) {

        $c = 1;
        foreach ($events as $event) {
          $edit = route('events.edit', encrypt($event->id));
          $view = route('events.show', encrypt($event->id));

          $nestedData['id'] = $c;
          $nestedData['title'] = $event->title;
          $nestedData['location'] = $event->location;
          $nestedData['cover_image'] = '<img src="'.$event->cover_image.'" height="100" width="100">';
          $nestedData['start_date'] = $event->start_date->toFormattedDateString();

          $nestedData['created_by'] = $event->createdBy->name;
          $nestedData['updated_by'] = ((bool)$event->updated_by)?$event->updatedBy->name:'';
          $nestedData['created_at'] = $event->created_at->toDateTimeString();
          $nestedData['actions'] = '<div class="button-items">';
          if(auth()->user()->can('update executive members')){
            $nestedData['actions'] .= '<a href="'.$edit.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Update</a>';
          }
          if(auth()->user()->can('delete executive members')){
            $nestedData['actions'] .= ' <a href="'.$view.'" type="button" class="btn btn-sm btn-secondary waves-effect waves-light">View</a>';
          }
          $nestedData['actions'] .= '</div>';
          $c++;
          $data[] = $nestedData;

        }

      }
      $json_data = array(
        "draw" => intval($request->input('draw')),
        "recordsTotal" => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        "data" => $data
      );
      echo json_encode($json_data);
    }

    public function create()
    {
      return view('event::back.events.create');
    }

    public function store(EventStoreRequest  $request)
    {

      try{
        DB::beginTransaction();
        $event = $this->eventContract->create([
          'title'=>$request->title,
          'location'=>$request->location,
          'description'=>$request->description,
          'cover_image'=>$request->coverImage,
          'start_date'=>$request->startDate,
          'end_date'=>$request->endDate,
          'start_time'=>$request->startTime,
          'schedule'=>$request->schedule,
          'slug'=>Str::slug($request->title,'-')
        ]);

        $this->activityContract->create([
          'entity_id'=>$event->id,
          'entity_type'=>'Event',
          'activity'=>'Event with title '.$event->name.' created',
          'link'=>route('events.index'),
          'type'=>'green'
        ]);
        DB::commit();
        return redirect()
          ->route('events.index')
          ->with('success','Event added successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getCode());
      }

    }

    public function show($id)
    {
      $event = $this->eventContract->find(decrypt($id));
      return view('event::back.events.show',compact('event'));
    }

    public function edit($id)
    {
      $event = $this->eventContract->find(decrypt($id));
      return view('event::back.events.edit',compact('event'));
    }

    public function update(EventStoreRequest $request,$id){
      $event = $this->eventContract->find(decrypt($id));
      try{
        DB::beginTransaction();

        $this->eventContract->update($event->id,[
          'title'=>$request->title,
          'location'=>$request->location,
          'description'=>$request->description,
          'cover_image'=>$request->coverImage,
          'start_date'=>$request->startDate,
          'end_date'=>$request->endDate,
          'start_time'=>$request->startTime,
          'schedule'=>$request->schedule,
          'slug'=>Str::slug($request->title,'-')
        ]);

        $this->activityContract->create([
          'entity_id'=>$event->id,
          'entity_type'=>'Event',
          'activity'=>'Event with title '.$event->title.' updated',
          'link'=>route('events.index'),
          'type'=>'blue'
        ]);
        DB::commit();
        return redirect()
          ->route('events.index')
          ->with('success','Event updated successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getCode());
      }

    }

    public function destroy($id){
      $event = $this->eventContract->find(decrypt($id));
      try{
        DB::beginTransaction();
        $this->eventContract->delete($event->id);
        $this->activityContract->create([
          'entity_id'=>$event->id,
          'entity_type'=>'Event',
          'activity'=>'Event with title '.$event->title.' deleted',
          'link'=>route('events.index'),
          'type'=>'red'
        ]);
        DB::commit();
        return redirect()
          ->route('events.index')
          ->with('success','Event deleted successfully.');
      } catch (\Exception $e){
        DB::rollBack();
        return redirect()
          ->back()
          ->withInput()
          ->with('warning','Error: '.$e->getCode());
      }

    }
  }
