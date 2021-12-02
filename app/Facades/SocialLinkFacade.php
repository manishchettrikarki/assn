<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class SocialLinkFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'social';
    }
}
