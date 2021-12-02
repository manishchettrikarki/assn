<?php


namespace Modules\User\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\User\Repositories\Contracts\UserContract;
use Modules\User\Repositories\Eloquent\UserRepository;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function  boot(){

    }

    public function register(){
        $this->app->bind(UserContract::class,UserRepository::class);
    }
}
