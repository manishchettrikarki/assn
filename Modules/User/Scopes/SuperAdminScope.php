<?php


namespace Modules\User\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SuperAdminScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('roles',function($query){
            $query->where('name','!=','Super Admin');
        });
    }
}
