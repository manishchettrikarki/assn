<?php


namespace Modules\CMS\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\CMS\Repositories\Contracts\PageContract;
use Modules\CMS\Repositories\Contracts\SliderContract;
use Modules\CMS\Repositories\Eloquent\PageRepository;
use Modules\CMS\Repositories\Eloquent\SliderRepository;

class CmsRepositoryServiceProvider extends ServiceProvider
{
    public function boot(){

    }

    public function register(){
        $this->app->bind(PageContract::class,PageRepository::class);
        $this->app->bind(SliderContract::class,SliderRepository::class);
    }
}
