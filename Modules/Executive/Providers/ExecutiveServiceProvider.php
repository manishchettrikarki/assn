<?php

namespace Modules\Executive\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Executive\Models\ExecutiveMessage;

class ExecutiveServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('Executive', 'Database/Migrations'));
        $messages = ExecutiveMessage::get();
        view()->composer('partials.nav',function($view)use($messages){
            $view->with(compact('messages'));
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ExecutiveRepositoryServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Executive', 'Config/config.php') => config_path('executive.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Executive', 'Config/config.php'), 'executive'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/executive');

        $sourcePath = module_path('Executive', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/executive';
        }, \Config::get('view.paths')), [$sourcePath]), 'executive');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/executive');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'executive');
        } else {
            $this->loadTranslationsFrom(module_path('Executive', 'Resources/lang'), 'executive');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Executive', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
