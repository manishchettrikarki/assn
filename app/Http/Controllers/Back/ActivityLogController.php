<?php


namespace App\Http\Controllers\Back;


use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ActivityLogController extends Controller
{
    public $activityContract;

    public function index(){
        return view('back.activity');
    }

    public function getActivities(Request $request){
        $columns = array(
            0 => 'id',
            1 => 'entity_type',
            2 => 'user_id',
            3 => 'activity',
            4 => 'created_at',
            5 => 'actions',
        );
        $totalData = ActivityLog::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
                $logs = ActivityLog::offset($start)
                    ->limit($limit)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $logs = ActivityLog::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        } else {
            $search = $request->input('search.value');
            $logs = ActivityLog::where('user_id', 'LIKE', '%' . $search . '%')
                ->orWhere('entity_type', 'LIKE', '%' . $search . '%')
                ->orWhere('activity', 'LIKE', '%' . $search . '%')
                ->orWhere('link', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = ActivityLog::where('user_id', 'LIKE', '%' . $search . '%')
                ->orWhere('entity_type', 'LIKE', '%' . $search . '%')
                ->orWhere('activity', 'LIKE', '%' . $search . '%')
                ->orWhere('link', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($logs)) {
            $c = 1;
            foreach ($logs as $log) {
                if(!is_null($log->link)){
                    $action = '<div class="button-items">
                                        <a href="'.$log->link.'" type="button"  class="btn btn-sm btn-outline-primary waves-effect waves-light delete">View</a>
                                    </div>';
                } else {
                    $action = 'Unavailable';
                }

                $nestedData['id'] = $c;
                $nestedData['created_at'] = $log->created_at->toDateTimeString();
                if((bool)$log->user_id){
                    $nestedData['user_id'] = $log->activist->name;
                } else {
                    $nestedData['user_id'] = '-';
                }

                $nestedData['entity_type'] = $log->entity_type;
                $nestedData['activity'] = $log->activity;

                $nestedData['actions'] = $action;
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
}
