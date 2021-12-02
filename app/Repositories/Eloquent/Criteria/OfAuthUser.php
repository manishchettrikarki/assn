<?php


namespace App\Repositories\Eloquent\Criteria;


use App\Repositories\Criteria\CriterionContract;

class OfAuthUser implements CriterionContract
{
    protected $column;
    public function __construct($column = 'user_id')
    {
        $this->column = $column;
    }

    public function apply($model)
    {
        return $model->where($this->column,auth()->id());
    }
}
