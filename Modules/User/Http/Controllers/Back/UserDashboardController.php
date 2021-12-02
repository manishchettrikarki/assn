<?php


namespace Modules\User\Http\Controllers\Back;


use App\Http\Controllers\Back\DashboardController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserDashboardController extends DashboardController
{
    public function getCardData(Request $request) {
        if($request->ajax()){
            $date = Carbon::now();
            $currentNewUsers = $this->getMonthlyData($date);
            $previousNewUsers = $this->getMonthlyData($date->subMonth());
            $response['users'] = $currentNewUsers;
            $totalUsers = $currentNewUsers + $previousNewUsers;
            if($totalUsers <= 0){
                $response['trend'] = $this->getDecreasingIndex(0);
            } else {
                $margin = ($currentNewUsers - $previousNewUsers)/$totalUsers * 100;
                if($margin > 0){
                    $response['trend'] = $this->getIncreasingIndex($margin);
                } else {
                    $response['trend'] = $this->getDecreasingIndex($margin);
                }
            }
            return response()
                ->json(json_encode($response),200);
        } else {
            return response()
                ->json('Invalid action',404);
        }
    }

    public function getMonthlyData($month) {
        return $this->userContract->ofMonth('created_at',$month)->count();
    }
}
