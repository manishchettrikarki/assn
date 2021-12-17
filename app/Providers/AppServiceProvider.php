<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        Schema::defaultStringLength(191);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(ViewComposerServiceProvider::class);
        $this->app->register(HelperServiceProvider::class);
        $this->app->bind('site',Setting::class);
        $this->app->bind('social',SocialLink::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('recaptcha','App\\Http\\Validators\\ReCaptcha@validate');
    }
}
