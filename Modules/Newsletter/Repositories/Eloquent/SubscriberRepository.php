<?php


namespace Modules\Newsletter\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Newsletter\Models\Subscriber;
use Modules\Newsletter\Repositories\Contract\SubscriberContract;

class SubscriberRepository extends BaseRepository implements SubscriberContract
{
    public function model()
    {
        return Subscriber::class;
    }

    public function geSubscribersList()
    {
        return DB::table('subscribers')->select('name','email')
            ->where('email_verified','=',true)->get();
    }
}
