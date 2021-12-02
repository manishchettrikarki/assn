<?php


namespace App\Repositories\Eloquent;


use App\Models\ActivityLog;
use App\Repositories\Contracts\ActivityLogContract;

class ActivityLogRepository extends BaseRepository implements ActivityLogContract
{
    public function model(){
        return ActivityLog::class;
    }
}
