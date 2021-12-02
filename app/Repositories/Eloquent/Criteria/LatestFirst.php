<?php


namespace App\Repositories\Eloquent\Criteria;


use App\Repositories\Criteria\CriterionContract;

class LatestFirst implements CriterionContract
{

    public function apply($model)
    {
        return $model->latest();
    }
}
