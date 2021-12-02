<?php


namespace App\Providers;


use App\Repositories\Contracts\{ActivityLogContract,
    DomesticAirlineContract,
    DomesticAirportContract,
    InternationalAirlineContract,
    InternationalAirportContract,
    SettingContract,
    SocialLinkContract};
use App\Repositories\Eloquent\{ActivityLogRepository,
    DomesticAirlineRepository,
    DomesticAirportRepository,
    InternationalAirlineRepository,
    InternationalAirportRepository,
    SettingRepository,
    SocialLinkRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind(SocialLinkContract::class,SocialLinkRepository::class);
        $this->app->bind(ActivityLogContract::class,ActivityLogRepository::class);
        $this->app->bind(SettingContract::class,SettingRepository::class);
    }

    public function boot(){

    }
}
