<?php


namespace App\Repositories\Eloquent\Criteria;


use App\Repositories\Criteria\CriterionContract;

class WithTrashed implements CriterionContract
{

    public function apply($model)
    {
        return $model->withTrashed();
    }
}
