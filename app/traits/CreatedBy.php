<?php

namespace App\traits;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::saving(function($model){
            $column = $model->creator();
            if(auth()->check()){
                $model->$column = auth()->id();
            }

        });
    }

    abstract public function creator() :string;
}
