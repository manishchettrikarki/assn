<?php


namespace App\Http\Controllers\Back;


use App\Repositories\Eloquent\Criteria\LatestFirst;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\InternationalFlight\Repositories\Contracts\FlightBookingContract;
use Modules\Payment\Repositories\Contracts\TransactionContract;
use Modules\User\Repositories\Contracts\UserContract;
use Modules\Yeti\Repositories\Contracts\YetiBookingContract;

class DashboardController extends Controller
{
    public $userContract;

    public function __construct(

        UserContract $userContract
    )
    {
        $this->middleware('can:view dashboard');

        $this->userContract = $userContract;
    }

    public function dashboard(){
//        dd(site('logo'));

        return view('back.dashboard');
    }

    public function getAllGraphData(Request $request) {
        if($request->ajax()){
            $months = $this->getMonths();
            $yetiBooking = $this->getYetiBookingData($months);
            $sabreBooking = $this->getSabreBookingData($months);
            $userRegistered = $this->getUserResgisteredData($months);
            $formattedMonths = [];
            foreach ($months as $month){
                array_push($formattedMonths,Carbon::createFromFormat('Y-M', $month)->format('M-y'));
            }
            $response['months'] = json_encode(array_reverse($formattedMonths));
            $response['yeti'] = json_encode(array_reverse($yetiBooking));
            $response['sabre'] = json_encode(array_reverse($sabreBooking));
            $response['user'] = json_encode(array_reverse($userRegistered));

            return response()->json($response,200);
        } else {
            return response()->json('Invalid method',404);
        }
    }

    public function getMonths() {
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("Y-M", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        return $months;
    }

    public function getYetiBookingData($months){
        $bookingData = [];
        foreach ($months as $month){
            array_push($bookingData,
                $this->yetiContract
                    ->ofMonth('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->whereYear('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->where('pnr','!=',null)
                    ->count()
            );
        }

        return $bookingData;
    }

    public function getSabreBookingData($months){
        $bookingData = [];
        foreach ($months as $month){
            array_push($bookingData,
                $this->sabreContract
                    ->ofYear('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->whereMonth('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->where('pnr_id','!=',null)
                    ->count()
            );
        }

        return $bookingData;
    }

    public function getUserResgisteredData($months) {
        $userData = [];
        foreach ($months as $month){
            array_push($userData,
                $this->userContract->withTrashed()
                    ->whereYear('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->whereMonth('created_at',Carbon::createFromFormat('Y-M', $month))
                    ->count()
            );
        }

        return $userData;
    }

    public function getAllTodayData(Request $request){
        if($request->ajax()){

            $data[] = $this->getTodaysSabreBooking();
            $data[] = $this->getTodaysYetiBooking();

            return response()->json(json_encode($data),200);
        } else {
            return response()
                ->json('Invalid action',404);
        }
    }

    public function getTodaysSabreBooking(){
        return $this->sabreContract
            ->ofDay('created_at',Carbon::today())
            ->where('pnr_id','!=',null)
            ->count();
    }

    public function getTodaysYetiBooking(){
        return $this->yetiContract
            ->ofDay('created_at',Carbon::today())
            ->where('pnr','!=',null)
            ->count();
    }

    public function getIncreasingIndex($index){
        return '<span class="text-success">'.$index.'% <i class="mdi mdi-trending-up mr-1"></i></span>
                From previous month';
    }

    public function getDecreasingIndex($index) {
        return '<span class="text-danger">'.$index.'% <i class="mdi mdi-trending-down mr-1"></i></span>
                From previous month';
    }
}
