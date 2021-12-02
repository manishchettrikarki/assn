<?php


namespace Modules\Newsletter\Http\Controllers\Back;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Newsletter\Models\Subscriber;
use Modules\Newsletter\Repositories\Contract\SubscriberContract;

class SubscriberController extends Controller
{
    public $subscriberContract;

    public function __construct(SubscriberContract $subscriberContract)
    {
        $this->subscriberContract = $subscriberContract;
    }

    public function index(){
        return view('newsletter::back.subscribers.index');
    }

    public function getSubscriberData(Request $request){
        if(!$request->ajax()){
            abort(404);
        }
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'email_verified',
            4 => 'created_at',
            5 => 'actions',
        );
        $totalData = Subscriber::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(($request->input('order.0.column') == 0) && $request->input('order.0.dir') == 'asc'){
                if($limit == -1){
                    $subscribers = Subscriber::orderBy('created_at', 'desc')
                        ->get();
                } else {
                    $subscribers = Subscriber::offset($start)
                        ->limit($limit)
                        ->orderBy('created_at', 'desc')
                        ->get();
                }

            } else {
                if($limit == -1){
                    $subscribers = Subscriber::orderBy($order, $dir)
                        ->get();
                } else {
                    $subscribers = Subscriber::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
                }

            }
        } else {
            $search = $request->input('search.value');
            if($limit == -1){
                $subscribers = Subscriber::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $subscribers = Subscriber::where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
            $totalFiltered = Subscriber::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->count();
        }
        $data = array();
        if (!empty($subscribers)) {
            $c = $start + 1;
            foreach ($subscribers as $subscriber) {
                $mail = route('newsletter.mail',encrypt($subscriber->id));

                $nestedData['id'] = $c;
                $nestedData['name'] = $subscriber->name;
                $nestedData['email'] = $subscriber->email;
                $nestedData['email_verified'] = ($subscriber->email_verified)?'Verified':'Unverified';
                $nestedData['created_at'] = $subscriber->created_at->toDateTimeString();

                $nestedData['actions'] = '<div class="button-items">
                                        <a href="'.$mail.'" type="button" class="btn btn-sm btn-primary waves-effect waves-light">Mail</a>
                                    </div>';
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
