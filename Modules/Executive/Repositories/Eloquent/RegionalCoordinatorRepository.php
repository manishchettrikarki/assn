<?php


namespace Modules\Executive\Repositories\Eloquent;


use App\Repositories\Eloquent\BaseRepository;
use Modules\Executive\Models\RegionalCoordinator;
use Modules\Executive\Repositories\Contracts\RegionalCoordinatorContract;

class RegionalCoordinatorRepository extends BaseRepository implements RegionalCoordinatorContract
{
    public function model()
    {
        return RegionalCoordinator::class;
    }
}
