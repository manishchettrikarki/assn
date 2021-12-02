<?php


namespace App\Repositories\Eloquent\Criteria;


use App\Repositories\Criteria\CriterionContract;

class TrueColumn implements CriterionContract
{
    protected $column;
    public function __construct($column = 'status')
    {
        $this->column = $column;
    }

    public function apply($model)
    {
        return $model->where($this->column,true);
    }
}
