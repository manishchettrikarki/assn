<?php

namespace  App\Providers;


use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function boot(){
        foreach(glob(app_path().'/Helpers/*.php') as $file){
            require_once($file);
        }
    }

    public function register(){

    }

}
