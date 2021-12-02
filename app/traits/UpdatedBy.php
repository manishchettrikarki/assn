<?php


namespace App\traits;


trait UpdatedBy
{
    public static function bootUpdatedBy()
    {
        static::saving(function($model){
            $property = $model->editor();
            if(auth()->check()){
                $model->$property = auth()->id();
            }

        });
    }

    abstract public function editor(): string;
}
